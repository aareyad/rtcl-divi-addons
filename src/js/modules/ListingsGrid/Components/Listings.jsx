import React from "react";

const Listings = (props) => {
    const attributes = props.data;
    const {rtcl_grid_style, rtcl_grid_column} = attributes;
    return (
        <div className="rtcl rtcl-listings-sc-wrapper">
            <div class="rtcl-listings-wrapper">
                <div className={`rtcl-listings columns-${rtcl_grid_column}`}>
                    loading...
                </div>
            </div>
        </div>
    );
}

export default Listings;