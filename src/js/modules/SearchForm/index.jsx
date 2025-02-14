// External Dependencies
import React, {Component} from 'react';

class SearchForm extends Component {
    static slug = 'rtcl_search_form';

    static css(props) {
        const additionalCss = [];

        // CSS Selectors
        const wrapper = ".et-db #et-boc .et-l %%order_class%% .rtcl-single-location";
        const titleSelector = `${wrapper} .rtcl-location-name`;

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