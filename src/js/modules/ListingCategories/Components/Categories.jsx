import axios from "axios";
import Qs from "qs";
import Layout_1 from "./Layout_1";
import classnames from "classnames";

const {useState, useEffect} = wp.element;

function Categories(props) {
    const attributes = props.settings;
    const {rtcl_cats_style, rtcl_grid_column, rtcl_category_limit} = attributes;
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

    const rtcl_grid_column_tablet = attributes?.rtcl_grid_column_tablet;
    const rtcl_grid_column_phone = attributes?.rtcl_grid_column_phone;

    attributes.rtcl_grid_class = classnames([
        'rtcl-categories',
        'rtcl-grid-view',
        'rtcl-category-' + rtcl_cats_style,
        'columns-' + rtcl_grid_column,
        'tab-columns-' + rtcl_grid_column_tablet,
        'mobile-columns-' + rtcl_grid_column_phone
    ]);

    function load_layout() {
        return false;
        return <Layout_1 settings={attributes} data={data}/>
    }

    return (
        <div className="rtcl rtcl-categories-wrapper rtcl-divi-module">
            {load_layout()}
        </div>
    );
}

export default Categories;