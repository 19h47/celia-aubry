<?php // phpcs:ignore
/**
 * Bootstraps WordPress theme related functions, most importantly enqueuing javascript and styles.
 *
 * @package WordPress
 * @subpackage CeliaAubry
 */

namespace CeliaAubry;

/**
 * Init
 */
class Init {

	/**
	 * Store all the classes inside an array
	 *
	 * @return array Full list of classes
	 */
	public static function get_services(): array {
		return array(
			Setup\Enqueue::class,
			Setup\Settings::class,
			Setup\Context::class,
			Setup\Twig::class,
			Setup\NavMenu::class,
			Setup\Supports::class,
			Setup\Textdomain::class,
			Setup\WordPress::class,
			Setup\QueryVars::class,
			PostTemplate\BodyClass::class,
			Vite::class
		);
	}


	/**
	 * Loop through the classes, initialize them, and call the run() method if it exists
	 *
	 * @return void
	 */
	public static function run_services(): void {
		foreach ( self::get_services() as $class ) {
			$service = self::instantiate( $class );

			if ( method_exists( $service, 'run' ) ) {
				$service->run();
			}
		}
	}


	/**
	 * Initialize the class
	 *
	 * @param  string $class class name from the services array.
	 * @return object
	 */
	private static function instantiate( string $class ): object {
		return new $class();
	}
}
