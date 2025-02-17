<?php

namespace RtclDiviAddons\Models;

class Dependencies {
	const MIN_RTCL = '4.0.4';

	private static $singleton = false;
	private array $missing = [];
	private bool $allOk = true;

	/**
	 * Create an inaccessible constructor.
	 */
	private final function __construct() {
	}


	/**
	 * Fetch an instance of the class.
	 */
	public static function getInstance() {
		if ( self::$singleton === false ) {
			self::$singleton = new self();
		}

		return self::$singleton;
	}

	/**
	 * @return bool
	 */
	public function check(): bool {

		if ( ! class_exists( \Rtcl::class ) ) {
			$link                                = esc_url(
				add_query_arg(
					array(
						'tab'       => 'plugin-information',
						'plugin'    => 'classified-listing',
						'TB_iframe' => 'true',
						'width'     => '640',
						'height'    => '500',
					), admin_url( 'plugin-install.php' )
				)
			);
			$this->missing['Classified Listing'] = $link;
			$this->allOk                         = false;
		}

		if ( ! empty( $this->missing ) ) {
			add_action( 'admin_notices', [ $this, '_missing_plugins_warning' ] );
		}

		return $this->allOk;
	}


	/**
	 * Adds admin notice.
	 */
	public function _missing_plugins_warning(): void {

		$missing = '';
		$counter = 0;
		foreach ( $this->missing as $title => $url ) {
			$counter ++;
			if ( $counter == sizeof( $this->missing ) ) {
				$sep = '';
			} elseif ( $counter == sizeof( $this->missing ) - 1 ) {
				$sep = ' ' . __( 'and', 'rtcl-divi-addons' ) . ' ';
			} else {
				$sep = ', ';
			}
			if ( $title === "Classified Listing" ) {
				$missing .= '<a class="thickbox open-plugin-details-modal" href="' . $url . '">' . $title . '</a>' . $sep;
			} else {
				$missing .= '<a href="' . $url . '">' . $title . '</a>' . $sep;
			}
		}
		?>

        <div class="message error">
            <p><?php echo wp_kses( sprintf( __( '<strong>Classified Listing - Addons for Divi Builder</strong> is enabled but not effective. It requires %s in order to work.',
					'rtcl-divi-addons' ), $missing ), [ 'strong' => [], 'a' => [ 'href' => true, 'class' => true ] ] ); ?></p>
        </div>
		<?php
	}
}
