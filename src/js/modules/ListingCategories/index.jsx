// External Dependencies
import React, {Component} from 'react';
import Categories from "./Components/Categories";

class ListingCategories extends Component {
    static slug = 'rtcl_listing_categories';

    static css(props) {
        const additionalCss = [];

        // CSS Selectors
        const wrapper = ".et-db #et-boc .et-l %%order_class%% .rtcl-categories-wrapper";
        const titleSelector = `${wrapper} .rtcl-category-title a`;

        // Settings
        const titleColor = props.rtcl_title_color;
        const titleHoverColor = props?.rtcl_title_color__hover;
        const countColor = props.rtcl_count_color;
        const countTextSize = props.rtcl_count_text_size;

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
                    selector: `${wrapper} .rtcl-category-title a:hover`,
                    declaration: `color: ${titleHoverColor};`
                }
            ]);
        }
        if ('' !== countColor) {
            additionalCss.push([
                {
                    selector: `${wrapper} .cat-details-inner .count`,
                    declaration: `color: ${countColor};`
                }
            ]);
        }
        if ('' !== countTextSize) {
            additionalCss.push([
                {
                    selector: `${wrapper} .cat-details-inner .count`,
                    declaration: `font-size: ${countTextSize};`
                }
            ]);
        }

        return additionalCss;
    }

    render() {
        return (
            <Categories settings={this.props}/>
        );
    }
}

export default ListingCategories;