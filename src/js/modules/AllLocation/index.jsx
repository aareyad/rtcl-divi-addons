// External Dependencies
import React, {Component} from 'react';
import Location from "./Components/Location";
import {SettingsProvider} from "../SettingsProvider";

class AllLocation extends Component {
    static slug = 'rtcl_listing_all_location';

    static css(props) {
        const additionalCss = [];

        // CSS Selectors
        const wrapper = ".et-db #et-boc .et-l %%order_class%% .rtcl-location-wrapper";
        const titleSelector = `${wrapper} .rtcl-location-title a`;

        // Settings
        const titleColor = props.rtcl_title_color;
        const titleHoverColor = props?.rtcl_title_color__hover;
        const descriptionColor = props.rtcl_desc_color;
        const countColor = props.rtcl_count_color;
        // box gutter responsive settings
        const boxGutter = props.rtcl_box_gutter;
        const isResponsiveBoxGutter = props.rtcl_box_gutter_last_edited && props.rtcl_box_gutter_last_edited.startsWith("on");
        const boxGutterTablet = isResponsiveBoxGutter && props.rtcl_box_gutter_tablet ? props.rtcl_box_gutter_tablet : boxGutter;
        const boxGutterPhone = isResponsiveBoxGutter && props.rtcl_box_gutter_phone ? props.rtcl_box_gutter_phone : boxGutter;

        // Apply CSS
        if ('' !== titleColor) {
            additionalCss.push([
                {
                    selector: titleSelector,
                    declaration: `color: ${titleColor};`
                }
            ]);
        }
        if ('' !== titleHoverColor && 'undefined' !== titleHoverColor) {
            additionalCss.push([
                {
                    selector: `${wrapper} .rtcl-location-title a:hover`,
                    declaration: `color: ${titleHoverColor};`
                }
            ]);
        }
        if ('' !== countColor) {
            additionalCss.push([
                {
                    selector: `${wrapper} .location-details-inner .count`,
                    declaration: `color: ${countColor};`
                }
            ]);
        }
        if ('' !== descriptionColor) {
            additionalCss.push([
                {
                    selector: `${wrapper} .location-details-inner p`,
                    declaration: `color: ${descriptionColor};`
                }
            ]);
        }
        if (boxGutter) {
            additionalCss.push([
                {
                    selector: `${wrapper} .rtcl-grid-view`,
                    declaration: `grid-gap: ${boxGutter};`
                }
            ])
        }
        if (boxGutterTablet) {
            additionalCss.push([
                {
                    selector: `${wrapper} .rtcl-grid-view`,
                    declaration: `grid-gap: ${boxGutterTablet};`,
                    device: 'tablet'
                }
            ])
        }
        if (boxGutterPhone) {
            additionalCss.push([
                {
                    selector: `${wrapper} .rtcl-grid-view`,
                    declaration: `grid-gap: ${boxGutterPhone};`,
                    device: 'phone'
                }
            ])
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

export default AllLocation;