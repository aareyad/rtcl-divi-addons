import Layout_1 from "./Layout_1";
import classnames from "classnames";
import {useSettings} from "../../SettingsProvider";

function Location(props) {
    const attributes = useSettings();

    const {
        rtcl_location_style,
        rtcl_grid_column,
        __location
    } = attributes;

    attributes.rtcl_grid_class = classnames([
        'rtcl-location-items-wrapper',
        'rtcl-grid-view',
        'rtcl-location-' + rtcl_location_style,
        'columns-' + rtcl_grid_column,
        (attributes?.rtcl_grid_column_tablet) ? 'tab-columns-' + attributes.rtcl_grid_column_tablet : 'tab-columns-2',
        (attributes?.rtcl_grid_column_phone) ? 'mobile-columns-' + attributes.rtcl_grid_column_phone : 'mobile-columns-1'
    ]);

    function load_layout() {
        return <Layout_1 settings={attributes} data={__location}/>
    }

    return (
        <div className="rtcl rtcl-location-wrapper rtcl-divi-module">
            {load_layout()}
        </div>
    );
}

export default Location;