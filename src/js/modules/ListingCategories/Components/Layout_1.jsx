const {__} = wp.i18n;

function Layout_1({settings, data}) {
    const {
        rtcl_show_image,
        rtcl_show_description,
        rtcl_content_limit,
        rtcl_show_labels,
        rtcl_show_date,
        rtcl_show_views,
        rtcl_show_ad_types,
        rtcl_show_location,
        rtcl_show_category,
        rtcl_show_price,
        rtcl_show_user,
        rtcl_show_favourites,
        rtcl_show_quick_view,
        rtcl_show_compare,
        rtcl_show_custom_fields,
        rtcl_grid_class,
        rtcl_no_listing_text
    } = settings;

    return [

        data.length ? (
            <div className="rtcl rtcl-gb-block">
                <div className={colClasses}>
                    {data.map((catlist, index) => (

                        <div className={boxContainerClass} key={index}>
                            {content_visibility["icon"] && catlist.icon_html ?
                                <div className={icon_type == 'icon' ? 'item-icon' : 'item-image'}> <a href={catlist.permalink} dangerouslySetInnerHTML={{ __html: catlist.icon_html }}></a></div> : ''}
                            <div className="item-content">
                                <h3 className="title"><a href={catlist.permalink} dangerouslySetInnerHTML={{ __html: catlist.name }}></a></h3>
                                {content_visibility["counter"] && catlist.count ? <div className="counter">{!count_after_text ? catlist.count == 1 ? catlist.count + __(' Ad') : catlist.count + __(' Ads') : catlist.count + ' ' + count_after_text}</div> : ''}
                                {content_visibility["catDesc"] && catlist.description ? <p className="content">{`${catlist.description.split(' ', content_limit).join(' ') + '....'}`}</p> : ''}
                            </div>
                        </div>
                    ))}

                </div>
            </div>
        ) : '',

    ]
}

export default Layout_1;
