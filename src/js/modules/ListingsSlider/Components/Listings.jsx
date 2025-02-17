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
        __location,
        __categories,
        rtcl_listing_types,
        rtcl_grid_column,
        rtcl_slider_auto_height,
        rtcl_slider_loop,
        rtcl_slider_autoplay,
        rtcl_slider_stop_on_hover,
        rtcl_slider_dot,
        rtcl_slider_arrow,
        rtcl_listing_per_page
    } = attributes;

    console.log(__categories);
    console.log(__location);

    const [data, setData] = useState([]);
    const [dataSuccess, setDataSuccess] = useState(true);

    const ajaxAttributes = {
        cats: __categories,
        locations: __location,
        listing_type: rtcl_listing_types === 'all' ? '' : rtcl_listing_types,
        orderby: attributes.rtcl_orderby,
        sortby: attributes.rtcl_sortby,
        perPage: rtcl_listing_per_page > 4 ? 4 : rtcl_listing_per_page,
        image_size: attributes.rtcl_image_size,
    };

    useEffect(() => {
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
            })
            .catch((error) => console.log(error));
    }, [__categories, __location, rtcl_listing_types]);

    const sliderClass = classnames([
        'rtcl-listings-slider-container',
        'rtcl-listings',
        'rtcl-carousel-slider',
        'rtcl-grid-' + rtcl_grid_style
    ]);

    const wrapperClass = classnames([
        'rtcl-unique-class-' + Math.random(),
        'on' === rtcl_slider_dot ? 'rtcl-slider-pagination-style-4' : '',
        'on' === rtcl_slider_arrow ? 'rtcl-slider-btn-style-1' : ''
    ]);

    const sliderOptions = {
        slidesPerView: rtcl_grid_column,
        slidesPerGroup: rtcl_grid_column,
        spaceBetween: 20,
        loop: 'on' === rtcl_slider_loop,
        slideClass: 'swiper-slide-customize',
        autoplay: 'on' === rtcl_slider_autoplay,
        pagination: false,
        navigation: false,
        autoHeight: 'on' === rtcl_slider_auto_height
    };

    function load_layout() {
        if ('style-2' === rtcl_grid_style) {
            return <Layout_2 settings={attributes} data={data}/>
        } else {
            return <Layout_1 settings={attributes} data={data}/>
        }
    }

    return (
        <div
            className={`rtcl rtcl-listings-wrapper rtcl-divi-module ${wrapperClass}`}>
            <div
                className={`swiper ${sliderClass}`} data-options={JSON.stringify(sliderOptions)}>
                {load_layout()}
            </div>
        </div>
    );
}

export default Listings;