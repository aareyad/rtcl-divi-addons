// External Dependencies
import React, {Component} from 'react';

class Button extends Component {

    static slug = 'rtcl_divi_button';

    render() {
        return (
            <div class="rtcl-button">
                <a href="">{this.props.content()}</a>
            </div>
        );
    }
}

export default Button;