// External Dependencies
import React, {Component, Fragment} from 'react';
import Listings from './Components/Listings';

//import './style.scss';

class ListingsGrid extends Component {
    static slug = 'rtcl_listings_grid';

    static css(props) {
        const additionalCss = [];

        // CSS Selectors
        const wrapper = ".et-db #et-boc .et-l %%order_class%% .rtcl-listings-wrapper";
        const titleSelector = `${wrapper} .rtcl-listing-title a`;
        const priceSelector = `${wrapper} .listing-price .rtcl-price`;
        const metaSelector = `${wrapper} .rtcl-listing-meta-data`;
        const metaIconSelector = `${wrapper} .rtcl-listing-meta-data i`;
        const categorySelector = `${wrapper} .listing-cat`;

        // Settings
        const titleColor = props.rtcl_title_color;
        const titleHoverColor = props?.rtcl_title_color__hover;
        const priceColor = props.rtcl_price_color;
        const metaColor = props.rtcl_meta_color;
        const metaIconColor = props.rtcl_meta_icon_color;
        const categoryColor = props.rtcl_meta_category_color;
        const categoryHoverColor = props?.rtcl_meta_category_color__hover;

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
        if ('' !== priceColor) {
            additionalCss.push([
                {
                    selector: priceSelector,
                    declaration: `color: ${priceColor};`
                }
            ]);
        }
        if ('' !== metaColor) {
            additionalCss.push([
                {
                    selector: metaSelector,
                    declaration: `color: ${metaColor};`
                }
            ]);
        }
        if ('' !== metaIconColor) {
            additionalCss.push([
                {
                    selector: metaIconSelector,
                    declaration: `color: ${metaIconColor};`
                }
            ]);
        }
        if ('' !== categoryColor) {
            additionalCss.push([
                {
                    selector: categorySelector,
                    declaration: `color: ${categoryColor};`
                }
            ]);
        }
        if ('' !== categoryHoverColor) {
            additionalCss.push([
                {
                    selector: `${wrapper} .listing-cat a:hover`,
                    declaration: `color: ${categoryHoverColor};`
                }
            ]);
        }

        return additionalCss;
    }

    render() {

        return (
            <Listings data={this.props}/>
        );
    }
}

export default ListingsGrid;