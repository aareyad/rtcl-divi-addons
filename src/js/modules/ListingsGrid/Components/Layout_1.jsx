const {__} = wp.i18n;
import classnames from 'classnames';

function Layout_1({settings, data}) {
    const {
        rtcl_grid_style,
        rtcl_grid_column,
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
        rtcl_show_user
    } = settings;

    const gridContainerClassNames = classnames([
        'rtcl-grid-view',
        'columns-' + rtcl_grid_column,
        'rtcl-divi-grid-style-' + rtcl_grid_style
    ]);

    return [
        data.length ? (
            <div className="rtcl rtcl-gb-block">
                <div className={gridContainerClassNames}>

                    {data.map((listing, index) => (
                        <div key={index}
                             className={[Object.values(listing.classes)]}>

                            {(rtcl_show_image === 'on' && listing.thumbnail) ? (
                                <div className="listing-thumb">
                                    <a href={listing.post_link} className="rtcl-media"
                                       dangerouslySetInnerHTML={{__html: listing.thumbnail}}></a>
                                </div>
                            ) : ''}

                            <div className="item-content">

                                {(rtcl_show_labels === 'on' && listing.badges) ? (
                                    <div className="listing-badge-wrap"
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

                                <ul className="rtcl-listing-meta-data">
                                    {(rtcl_show_ad_types === 'on' && listing.listing_type) ? (
                                        <li className="listing-type"><i
                                            className="rtcl-icon rtcl-icon-tags"></i>{listing.listing_type}</li>
                                    ) : ''}
                                    {(rtcl_show_date === 'on' && listing.time) ? (
                                        <li className="updated"><i
                                            className="rtcl-icon rtcl-icon-clock"></i>{listing.time}</li>
                                    ) : ''}
                                    {(rtcl_show_user === 'on' && listing.author) ? (
                                        <li className="author"><i
                                            className="rtcl-icon rtcl-icon-user"></i>{listing.author}</li>
                                    ) : ''}
                                    {(rtcl_show_location === 'on' && listing.locations) ? (
                                        <li className="rt-location"><i
                                            className="rtcl-icon rtcl-icon-location"></i><span
                                            dangerouslySetInnerHTML={{__html: listing.locations}}></span></li>
                                    ) : ''}
                                    {(rtcl_show_views === 'on' && listing.views) ? (
                                        <li className="rt-views"><i
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
            </div>
        ) : '',
    ]
}

export default Layout_1;
