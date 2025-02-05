import {useSettings} from "../../SettingsProvider";
import {WrapperComponent} from "./WrapperComponent";

const {__} = wp.i18n;

function Layout_1(props) {

    const data = props.data;

    const settings = useSettings();

    const {
        rtcl_show_count,
        rtcl_enable_link,
        rtcl_content_alignment
    } = settings;

    return [

        data && data.length ? (
            <div className="rtcl-single-location-inner">
                <WrapperComponent link={rtcl_enable_link === 'on' ? data?.[0]?.permalink : null}>
                    <div className="rtcl-location-img"></div>
                    <div className={`rtcl-location-content text-${rtcl_content_alignment}`}>
                        <h3 className="rtcl-location-name">{data?.[0]?.title}</h3>
                        {(rtcl_show_count === 'on' && data?.[0]?.count) ?
                            <div className="rtcl-location-listing-count">
                                {data[0].count == 1 ? data[0].count + __(' Ad') : data[0].count + __(' Ads')}
                            </div> : ''}
                    </div>
                </WrapperComponent>
            </div>
        ) : '',

    ]

}

export default Layout_1;