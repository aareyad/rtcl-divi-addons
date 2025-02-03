import classnames from 'classnames';

const {__} = wp.i18n;

function Layout_1(props) {

    const data = props.data;

    const {
        rtcl_grid_class,
        rtcl_content_limit,
        rtcl_icon_type,
        rtcl_description,
        rtcl_show_count,
        rtcl_show_image
    } = props.settings;

    return [

        data.length ? (
            <div className={rtcl_grid_class}>
                {data.map((catlist, index) => (

                    <div className="rtcl-cat-item" key={index}>
                        {'on' === rtcl_show_image && catlist.icon_html ?
                            <div className={rtcl_icon_type === 'icon' ? 'item-icon' : 'item-image'}><a
                                href={catlist.permalink} dangerouslySetInnerHTML={{__html: catlist.icon_html}}></a>
                            </div> : ''}
                        <div className="item-content">
                            <h3 className="title"><a href={catlist.permalink}
                                                     dangerouslySetInnerHTML={{__html: catlist.name}}></a></h3>
                            {'on' === rtcl_show_count && catlist.count ?
                                <div className="counter">catlist.count</div> : ''}
                            {'on' === rtcl_description && catlist.description ?
                                <p className="content">{`${catlist.description.split(' ', rtcl_content_limit).join(' ') + '....'}`}</p> : ''}
                        </div>
                    </div>
                ))}

            </div>
        ) : '',

    ]

}

export default Layout_1;