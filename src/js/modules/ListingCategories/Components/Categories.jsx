import axios from "axios";
import Qs from "qs";
import Layout_1 from "./Layout_1";
import classnames from "classnames";

const {useState, useEffect} = wp.element;

function Categories(props) {
    const attributes = props.settings;
    const {rtcl_cats_style, rtcl_grid_column, rtcl_category_limit} = attributes;
    const [dataSuccess, setDataSuccess] = useState(true);
    const [catListBox, setCatListBox] = useState([]);

    const ajaxAttributes = {
        cats: attributes.rtcl_cats === '' ? [] : [attributes.rtcl_cats],
        orderby: attributes.rtcl_orderby,
        sortby: attributes.rtcl_order,
        category_limit: rtcl_category_limit,
        hide_empty: attributes.rtcl_hide_empty,
    };

    useEffect(() => {
        let ajaxdata = {
            action: 'rtcl_gb_listing_cat_box',
            rtcl_nonce: rtcl_divi.rtcl_nonce,
            attributes: ajaxAttributes
        }

        axios.post(rtcl.ajaxurl, Qs.stringify(ajaxdata))
            .then((response) => {
                if (response.data.success) {
                    setCatListBox([...response.data.data]);
                    setDataSuccess(response.data.success)
                } else {
                    setCatListBox([]);
                    setDataSuccess(response.data.success)
                }
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
        return <Layout_1 settings={attributes} data={catListBox}/>
    }

    return (
        <div className="rtcl rtcl-categories-wrapper rtcl-divi-module">
            {load_layout()}
        </div>
    );
}

export default Categories;