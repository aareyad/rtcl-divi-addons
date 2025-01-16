import axios from "axios";
import Qs from "qs";
import Layout_1 from "./Layout_1";

const {useState, useEffect} = wp.element;

function Listings(props) {
    const attributes = props.data;
    const {rtcl_grid_style, rtcl_grid_column, rtcl_listing_per_page} = attributes;
    const [data, setData] = useState([]);
    const [dataSuccess, setDataSuccess] = useState(true);
    const [pageState, setPageState] = useState(0);

    const ajaxAttributes = {
        cats: attributes.rtcl_listing_categories === 'all' ? '' : attributes.rtcl_listing_categories,
        locations: attributes.rtcl_listing_location === 'all' ? '' : attributes.rtcl_listing_location,
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

    return (
        <div className="rtcl rtcl-listings-sc-wrapper">
            <div class="rtcl-listings-wrapper">
                <div className={`rtcl-listings columns-${rtcl_grid_column}`}>
                    <Layout_1 settings={attributes} data={data}/>
                </div>
            </div>
        </div>
    );
}

export default Listings;