// External Dependencies
import React, {Component} from 'react';

class SearchForm extends Component {
    static slug = 'rtcl_search_form';

    static css(props) {
        const additionalCss = [];

        // CSS Selectors
        const wrapper = ".et-db #et-boc .et-l %%order_class%% .rtcl-divi-listing-search";

        // Settings
        const formBg = props.form_background;
        const labelColor = props.form_label_color;
        const fieldBg = props.field_background;
        const fieldColor = props.field_text_color;
        const buttonBg = props.button_background;
        const buttonHoverBg = props?.button_background__hover;
        const buttonColor = props.button_color;
        const buttonHoverColor = props?.button_color__hover;
        // box gutter responsive settings
        const boxGutter = props.field_gap;
        const isResponsiveBoxGutter = props.field_gap_last_edited && props.field_gap_last_edited.startsWith("on");
        const boxGutterTablet = isResponsiveBoxGutter && props.field_gap_tablet ? props.field_gap_tablet : boxGutter;
        const boxGutterPhone = isResponsiveBoxGutter && props.field_gap_phone ? props.field_gap_phone : boxGutter;

        // Apply style
        if ('' !== formBg) {
            additionalCss.push([
                {
                    selector: `${wrapper}`,
                    declaration: `background-color: ${formBg};`
                }
            ]);
        }
        if ('' !== labelColor) {
            additionalCss.push([
                {
                    selector: `${wrapper} .form-group > label`,
                    declaration: `color: ${labelColor};`
                }
            ]);
        }
        if ('' !== fieldBg) {
            additionalCss.push([
                {
                    selector: `${wrapper} .rtcl-search-input-button`,
                    declaration: `background-color: ${fieldBg};`
                }
            ]);
        }
        if ('' !== fieldColor) {
            additionalCss.push([
                {
                    selector: `${wrapper} .rtcl-search-input-button .form-control`,
                    declaration: `color: ${fieldColor};`
                },
                {
                    selector: `${wrapper} .rtcl-search-input-button .form-control::placeholder`,
                    declaration: `color: ${fieldColor};`
                }
            ]);
        }
        if ('' !== buttonBg) {
            additionalCss.push([
                {
                    selector: `${wrapper} .rtcl-btn-holder .rtcl-search-btn`,
                    declaration: `background-color: ${buttonBg};`
                }
            ]);
        }
        if ('' !== buttonColor) {
            additionalCss.push([
                {
                    selector: `${wrapper} .rtcl-btn-holder .rtcl-search-btn`,
                    declaration: `color: ${buttonColor};`
                }
            ]);
        }
        if ('' !== buttonHoverBg && 'undefined' !== buttonHoverBg) {
            additionalCss.push([
                {
                    selector: `${wrapper} .rtcl-btn-holder .rtcl-search-btn:hover`,
                    declaration: `background-color: ${buttonHoverBg};`
                }
            ]);
        }
        if ('' !== buttonHoverColor && 'undefined' !== buttonHoverColor) {
            additionalCss.push([
                {
                    selector: `${wrapper} .rtcl-btn-holder .rtcl-search-btn:hover`,
                    declaration: `color: ${buttonHoverColor};`
                }
            ]);
        }
        if ('vertical' === props.search_orientation) {
            if (boxGutter) {
                additionalCss.push([
                    {
                        selector: `${wrapper} .rtcl-widget-search-form div + div`,
                        declaration: `margin-top: ${boxGutter};`
                    }
                ])
            }
            if (boxGutterTablet) {
                additionalCss.push([
                    {
                        selector: `${wrapper} .rtcl-widget-search-form div + div`,
                        declaration: `margin-top: ${boxGutterTablet};`,
                        device: 'tablet'
                    }
                ])
            }
            if (boxGutterPhone) {
                additionalCss.push([
                    {
                        selector: `${wrapper} .rtcl-widget-search-form div + div`,
                        declaration: `margin-top: ${boxGutterPhone};`,
                        device: 'phone'
                    }
                ])
            }
        } else {
            if (boxGutter) {
                additionalCss.push([
                    {
                        selector: `${wrapper} .rtcl-widget-search-form.rtcl-search-inline`,
                        declaration: `gap: ${boxGutter};`
                    }
                ])
            }
            if (boxGutterTablet) {
                additionalCss.push([
                    {
                        selector: `${wrapper} .rtcl-widget-search-form.rtcl-search-inline`,
                        declaration: `gap: ${boxGutterTablet};`,
                        device: 'tablet'
                    }
                ])
            }
            if (boxGutterPhone) {
                additionalCss.push([
                    {
                        selector: `${wrapper} .rtcl-widget-search-form.rtcl-search-inline`,
                        declaration: `gap: ${boxGutterPhone};`,
                        device: 'phone'
                    }
                ])
            }
        }

        return additionalCss;
    }

    render() {
        return (
            <div className="rtcl-divi-search-form-wrap"
                 dangerouslySetInnerHTML={{__html: this.props.__form_html}}></div>
        );
    }
}

export default SearchForm;