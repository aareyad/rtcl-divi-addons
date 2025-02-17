import axios from "axios";
import Qs from "qs";
import Layout_1 from "./Layout_1";
import Layout_2 from "./Layout_2";
import classnames from "classnames";

const {useState, useEffect} = wp.element;

function Listings(props) {
    const attributes = props.data;
    const {
        rtcl_grid_style,
        rtcl_grid_column,
        __categories,
        __location,
        rtcl_listing_types,
        rtcl_orderby,
        rtcl_sortby,
        rtcl_image_size,
        rtcl_listing_per_page
    } = attributes;

    const [data, setData] = useState([]);
    const [dataSuccess, setDataSuccess] = useState(true);
    const [pageState, setPageState] = useState(0);

    const ajaxAttributes = {
        cats: __categories,
        locations: __location,
        listing_type: rtcl_listing_types === 'all' ? '' : rtcl_listing_types,
        orderby: rtcl_orderby,
        sortby: rtcl_sortby,
        perPage: rtcl_listing_per_page,
        image_size: rtcl_image_size,
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
    }, [__categories, __location, rtcl_listing_types]);

    const rtcl_grid_column_tablet = attributes?.rtcl_grid_column_tablet;
    const rtcl_grid_column_phone = attributes?.rtcl_grid_column_phone;

    attributes.rtcl_grid_class = classnames([
        'rtcl-listings',
        'rtcl-grid-view',
        'columns-' + rtcl_grid_column,
        'tab-columns-' + rtcl_grid_column_tablet,
        'mobile-columns-' + rtcl_grid_column_phone,
        'rtcl-grid-' + rtcl_grid_style
    ]);

    function load_layout() {
        if ('style-2' === rtcl_grid_style) {
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