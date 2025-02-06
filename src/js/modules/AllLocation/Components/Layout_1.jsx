const {__} = wp.i18n;

function Layout_1(props) {

    const data = props.data;

    const {
        rtcl_grid_class,
        rtcl_content_limit,
        rtcl_description,
        rtcl_show_count,
        rtcl_content_alignment
    } = props.settings;

    return [

        data && data.length ? (
            <div className={rtcl_grid_class}>
                {data.map((termList, index) => (

                    <div className="rtcl-location-item" key={index}>
                        <div className={`location-details text-${rtcl_content_alignment}`}>
                            <div className="location-details-inner">
                                <h3 className="rtcl-location-title">
                                    <a href={termList.permalink} dangerouslySetInnerHTML={{__html: termList.name}}></a>
                                </h3>
                                {'on' === rtcl_show_count && termList.count ?
                                    <div className="count">{termList.count} <span
                                        class='count-text'>{__("ads")}</span></div> : ''}
                                {'on' === rtcl_description && termList.description ?
                                    <p>{`${termList.description.split(' ', rtcl_content_limit).join(' ') + '....'}`}</p> : ''}
                            </div>
                        </div>
                    </div>
                ))}

            </div>
        ) : '',

    ]

}

export default Layout_1;