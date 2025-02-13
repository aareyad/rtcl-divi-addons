// External Dependencies
import React, {Component} from 'react';
import {SettingsProvider} from '../SettingsProvider';

class SearchForm extends Component {
    static slug = 'rtcl_search_form';

    static css(props) {
        const additionalCss = [];

        // CSS Selectors
        const wrapper = ".et-db #et-boc .et-l %%order_class%% .rtcl-single-location";
        const titleSelector = `${wrapper} .rtcl-location-name`;

        // Settings
        const titleColor = props.rtcl_title_color;
        const countColor = props.rtcl_count_color;
        const contentBackground = props.rtcl_box_content_bg;
        // box height responsive settings
        const boxHeight = props.rtcl_box_height;
        const isResponsiveBoxHeight = props.rtcl_box_height_last_edited && props.rtcl_box_height_last_edited.startsWith("on");
        const boxHeightTablet = isResponsiveBoxHeight && props.rtcl_box_height_tablet ? props.rtcl_box_height_tablet : boxHeight;
        const boxHeightPhone = isResponsiveBoxHeight && props.rtcl_box_height_phone ? props.rtcl_box_height_phone : boxHeight;

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
        if (boxHeight) {
            additionalCss.push([
                {
                    selector: `${wrapper} .rtcl-single-location-inner`,
                    declaration: `height: ${boxHeight};`
                }
            ])
        }
        if (boxHeightTablet) {
            additionalCss.push([
                {
                    selector: `${wrapper} .rtcl-single-location-inner`,
                    declaration: `height: ${boxHeightTablet};`,
                    device: 'tablet'
                }
            ])
        }
        if (boxHeightPhone) {
            additionalCss.push([
                {
                    selector: `${wrapper} .rtcl-single-location-inner`,
                    declaration: `height: ${boxHeightPhone};`,
                    device: 'phone'
                }
            ])
        }

        return additionalCss;
    }

    render() {
        return (
            <SettingsProvider settings={this.props}>
                <h2>working</h2>
            </SettingsProvider>
        );
    }
}

export default SearchForm;