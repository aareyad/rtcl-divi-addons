// External Dependencies
import React, {Component} from 'react';
import Categories from "./Components/Categories";

class ListingCategories extends Component {
    static slug = 'rtcl_listing_categories';

    static css(props) {
        const additionalCss = [];

        // CSS Selectors
        const wrapper = ".et-db #et-boc .et-l %%order_class%% .rtcl-categories-wrapper";
        const titleSelector = `${wrapper} .rtcl-cat-title a`;

        // Settings
        const titleColor = props.rtcl_title_color;
        const titleHoverColor = props?.rtcl_title_color__hover;

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
                    selector: `${wrapper} .rtcl-listing-title a:hover`,
                    declaration: `color: ${titleHoverColor};`
                }
            ]);
        }

        return additionalCss;
    }

    render() {

        console.log(this.props.__categories)

        return (
            <>
            <h2>Workkdfjdkfjdfld</h2>
            </>
        );
    }
}

export default ListingCategories;