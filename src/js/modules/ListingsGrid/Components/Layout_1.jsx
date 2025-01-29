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
            <div className={rtcl_grid_class}>

                {data.map((listing, index) => (
                    <div key={index} className={[Object.values(listing.classes).join(" ")]}>

                        {(rtcl_show_image === 'on' && listing.thumbnail) ? (
                            <div className="listing-thumb">
                                <div className="listing-thumb-inner">
                                    <a href={listing.post_link} className="rtcl-media"
                                       dangerouslySetInnerHTML={{__html: listing.thumbnail}}></a>
                                    <div className="rtcl-meta-buttons-wrap">
                                        {rtcl_show_favourites === 'on' && listing.favourite_link ? (
                                            <div className="rtcl-el-button"
                                                 dangerouslySetInnerHTML={{__html: listing.favourite_link}}></div>
                                        ) : ''}
                                        {rtcl_show_quick_view === 'on' && listing.quick_view ? (
                                            <div className="rtcl-el-button"
                                                 dangerouslySetInnerHTML={{__html: listing.quick_view}}></div>
                                        ) : ''}
                                        {rtcl_show_compare === 'on' && listing.compare ? (
                                            <div className="rtcl-el-button"
                                                 dangerouslySetInnerHTML={{__html: listing.compare}}></div>
                                        ) : ''}
                                    </div>
                                </div>
                            </div>
                        ) : ''}

                        <div className="item-content">

                            {(rtcl_show_labels === 'on' && listing.badges) ? (
                                <div className="rtcl-listing-badge-wrap"
                                     dangerouslySetInnerHTML={{__html: listing.badges}}></div>
                            ) : ''}

                            {(rtcl_show_category === 'on' && listing.categories) ? (
                                <div className='listing-cat'
                                     dangerouslySetInnerHTML={{__html: listing.categories}}></div>
                            ) : ''}

                            {(listing.title) ? (
                                <h3 className="rtcl-listing-title"><a href={listing.post_link}>{listing.title}</a>
                                </h3>
                            ) : ''}

                            {(rtcl_show_custom_fields === 'on' && listing?.custom_field) ? (
                                <div className="rtcl-custom-field-warp"
                                     dangerouslySetInnerHTML={{__html: listing?.custom_field}}/>
                            ) : ''}

                            <ul className="rtcl-listing-meta-data">
                                {(rtcl_show_ad_types === 'on' && listing.listing_type) ? (
                                    <li className="listing-type"><i
                                        className="rtcl-icon rtcl-icon-tags"></i>{listing.listing_type}</li>
                                ) : ''}
                                {(rtcl_show_date === 'on' && listing.time) ? (
                                    <li className="listing-date"><i
                                        className="rtcl-icon rtcl-icon-clock"></i>{listing.time}</li>
                                ) : ''}
                                {(rtcl_show_user === 'on' && listing.author) ? (
                                    <li className="listing-author"><i
                                        className="rtcl-icon rtcl-icon-user"></i>{listing.author}</li>
                                ) : ''}
                                {(rtcl_show_location === 'on' && listing.locations) ? (
                                    <li className="listing-location"><i
                                        className="rtcl-icon rtcl-icon-location"></i><span
                                        dangerouslySetInnerHTML={{__html: listing.locations}}></span></li>
                                ) : ''}
                                {(rtcl_show_views === 'on' && listing.views) ? (
                                    <li className="listing-views"><i
                                        className="rtcl-icon rtcl-icon-eye"></i>{listing.views} {__("views", "rtcl-divi-addons")}
                                    </li>
                                ) : ''}
                            </ul>

                            {(rtcl_show_description === 'on' && listing.excerpt) ? (
                                <p className="rtcl-excerpt"
                                   dangerouslySetInnerHTML={{__html: listing.excerpt.split(' ', rtcl_content_limit).join(' ')}}></p>
                            ) : ''}
                            {(rtcl_show_price === 'on' && listing.price) ? (
                                <div className="item-price listing-price"
                                     dangerouslySetInnerHTML={{__html: listing.price}}></div>
                            ) : ''}
                        </div>
                    </div>
                ))}

            </div>
        ) : (<h3>{rtcl_no_listing_text}</h3>),
    ]
}

export default Layout_1;
