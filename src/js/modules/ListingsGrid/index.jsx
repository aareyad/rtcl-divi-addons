// External Dependencies
import React, {Component, Fragment} from 'react';
import Listings from './Components/Listings';

import './style.css';

class ListingsGrid extends Component {
    static slug = 'rtcl_listings_grid';

    static css(props) {
        const additionalCss = [];

        console.log(props);

        // CSS Selectors
        const wrapper = "%%order_class%% .rtcl-listings-wrapper";
        const titleSelector = `${wrapper} .rtcl-listing-title a`;

        // Title Settings
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

        return (
            <Listings data={this.props}/>
        );
    }
}

export default ListingsGrid;