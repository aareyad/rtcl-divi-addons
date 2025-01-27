import axios from "axios";
import Qs from "qs";
import Layout_1 from "./Layout_1";
import Layout_2 from "./Layout_2";
import classnames from "classnames";

const {useState, useEffect} = wp.element;

function Listings(props) {
    const attributes = props.data;
    const {rtcl_list_style, rtcl_listing_per_page} = attributes;
    const [data, setData] = useState([]);
    const [dataSuccess, setDataSuccess] = useState(true);
    const [pageState, setPageState] = useState(0);

    const ajaxAttributes = {
        cats: attributes.rtcl_listing_categories === 'all' ? '' : [attributes.rtcl_listing_categories],
        locations: attributes.rtcl_listing_location === 'all' ? '' : [attributes.rtcl_listing_location],
        listing_type: attributes.rtcl_listing_types === 'all' ? '' : attributes.rtcl_listing_types,
        orderby: attributes.rtcl_orderby,
        sortby: attributes.rtcl_sortby,
        perPage: attributes.rtcl_listing_per_page,
        image_size: attributes.rtcl_image_size,
    };

    useEffect(() => {
        let paginationLimit = 0;
        paginationLimit = rtcl_listing_per_page;
        let ajaxdata = {
            action: 'rtcl_gb_listings_ajax',
            rtcl_nonce: rtcl_divi.rtcl_nonce,
            attributes: ajaxAttributes
        }

        axios.post(rtcl.ajaxurl, Qs.stringify(ajaxdata))
            .then((response) => {
                if (response.data.success) {
                    setData([...response.data.data.posts]);
                    setDataSuccess(response.data.success)
                } else {
                    setData([]);
                    setDataSuccess(response.data.success)
                }
                setPageState(Math.ceil(response.data.data.total_post / ((paginationLimit == 0) || (paginationLimit == -1) ? 1 : paginationLimit)))
            })
            .catch((error) => console.log(error));
    }, []);

    attributes.rtcl_list_class = classnames([
        'rtcl-listings',
        'rtcl-list-view',
        'rtcl-list-' + rtcl_list_style
    ]);

    function load_layout() {
        if ('style-2' === rtcl_list_style) {
            return <Layout_2 settings={attributes} data={data}/>
        } else {
            return <Layout_1 settings={attributes} data={data}/>
        }
    }

    return (
        <div className="rtcl rtcl-listings-wrapper rtcl-divi-module">
            {load_layout()}
        </div>
    );
}

export default Listings;