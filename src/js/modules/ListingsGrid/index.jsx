// External Dependencies
import React, {Component, Fragment} from 'react';
import Listings from './Components/Listings';

import './style.css';

class ListingsGrid extends Component {
    static slug = 'rtcl_listings_grid';

    render() {

        return (
            <Listings data={this.props}/>
        );
    }
}

export default ListingsGrid;