import axios from "axios";
import Qs from "qs";
import Layout_1 from "./Layout_1";
import classnames from "classnames";

const {useState, useEffect} = wp.element;

function Categories(props) {
    const attributes = props.settings;

    const {
        rtcl_cats_style,
        rtcl_grid_column,
        rtcl_category_limit,
        rtcl_orderby,
        rtcl_order,
        rtcl_icon_type,
        __categories,
        rtcl_hide_empty
    } = attributes;

    const [dataSuccess, setDataSuccess] = useState(true);
    const [catListBox, setCatListBox] = useState([]);

    const ajaxAttributes = {
        cats: __categories,
        orderby: rtcl_orderby,
        sortby: rtcl_order,
        category_limit: rtcl_category_limit,
        icon_type: rtcl_icon_type,
        hide_empty: rtcl_hide_empty === 'on' ? 'true' : 'false',
        enable_parent: 'true',
        count_child: 'true',
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
    }, [__categories]);

    attributes.rtcl_grid_class = classnames([
        'rtcl-cat-items-wrapper',
        'rtcl-grid-view',
        'rtcl-category-' + rtcl_cats_style,
        'columns-' + rtcl_grid_column,
        (attributes?.rtcl_grid_column_tablet) ? 'tab-columns-' + attributes.rtcl_grid_column_tablet : 'tab-columns-2',
        (attributes?.rtcl_grid_column_phone) ? 'mobile-columns-' + attributes.rtcl_grid_column_phone : 'mobile-columns-1'
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