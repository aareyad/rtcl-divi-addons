import axios from "axios";
import Qs from "qs";
import classnames from 'classnames';

import {useSettings} from "../../SettingsProvider";
import Layout_1 from "./Layout_1";

const {useState, useEffect} = wp.element;

function Location(props) {

    const settings = useSettings();

    const {
        rtcl_location_style,
        rtcl_location_tax,
        rtcl_show_count
    } = settings;

    const ajaxAttributes = {
        location: rtcl_location_tax
    };

    const [data, setData] = useState([]);

    useEffect(() => {
        let ajaxdata = {
            action: 'rtcl_gb_single_location',
            rtcl_nonce: rtcl_divi.rtcl_nonce,
            attributes: ajaxAttributes
        }

        axios.post(rtcl.ajaxurl, Qs.stringify(ajaxdata))
            .then((response) => {
                if (response.data.success) {
                    setData([response.data.data]);
                } else {
                    setData([]);
                }
            })
            .catch((error) => console.log(error));
    }, []);

    const wrapperClass = classnames([
        'rtcl-single-location',
        (rtcl_show_count === 'on' && data?.[0]?.count) ? 'rtcl-has-count' : '',
        'rtcl-single-location-' + rtcl_location_style
    ])

    return (
        <div className={`rtcl rtcl-divi-module ${wrapperClass}`}>
            <Layout_1 data={data}/>
        </div>
    );
}

export default Location;