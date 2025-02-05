// External Dependencies
import React, {Component} from 'react';
import {SettingsProvider} from '../SettingsProvider';
import Location from "./Components/Location";

class SingleLocation extends Component {
    static slug = 'rtcl_single_location';

    static css(props) {
        const additionalCss = [];

        // CSS Selectors
        const wrapper = ".et-db #et-boc .et-l %%order_class%% .rtcl-single-location";
        const titleSelector = `${wrapper} .rtcl-location-name`;

        // Settings
        const titleColor = props.rtcl_title_color;
        const countColor = props.rtcl_count_color;
        const contentBackground = props.rtcl_box_content_bg;

        // Apply CSS
        if ('' !== titleColor) {
            additionalCss.push([
                {
                    selector: titleSelector,
                    declaration: `color: ${titleColor};`
                }
            ]);
        }
        if ('' !== countColor) {
            additionalCss.push([
                {
                    selector: `${wrapper} .rtcl-location-listing-count`,
                    declaration: `color: ${countColor};`
                }
            ]);
        }
        if ('' !== contentBackground) {
            additionalCss.push([
                {
                    selector: `${wrapper} .rtcl-location-content`,
                    declaration: `background-color: ${contentBackground};`
                }
            ]);
        }

        return additionalCss;
    }

    render() {
        return (
            <SettingsProvider settings={this.props}>
                <Location/>
            </SettingsProvider>
        );
    }
}

export default SingleLocation;