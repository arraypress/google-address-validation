<?php
/**
 * Google Address Validation API Parameters Trait
 *
 * @package     ArrayPress\Google\AddressValidation
 * @copyright   Copyright (c) 2024, ArrayPress Limited
 * @license     GPL2+
 * @version     1.0.0
 * @author      David Sherlock
 */

declare( strict_types=1 );

namespace ArrayPress\Google\AddressValidation\Traits;

use WP_Error;

/**
 * Trait Parameters
 *
 * Manages parameters for the Google Address Validation API.
 *
 * @package ArrayPress\Google\AddressValidation
 */
trait Parameters {

	/**
	 * API key for Google Address Validation
	 *
	 * @var string
	 */
	private string $api_key;

	/**
	 * Cache settings
	 *
	 * @var array
	 */
	private array $cache_settings = [
		'enabled'    => true,
		'expiration' => DAY_IN_SECONDS
	];

	/**
	 * Validation options
	 *
	 * @var array
	 */
	private array $options = [
		'enable_usps'       => false,
		'language_options'  => null,
		'previous_response' => null,
		'session_token'     => null
	];

	/** API Key ******************************************************************/

	/**
	 * Set API key
	 *
	 * @param string $api_key The API key to use
	 *
	 * @return self
	 */
	public function set_api_key( string $api_key ): self {
		$this->api_key = $api_key;

		return $this;
	}

	/**
	 * Get API key
	 *
	 * @return string
	 */
	public function get_api_key(): string {
		return $this->api_key;
	}

	/** Cache ********************************************************************/

	/**
	 * Set cache status
	 *
	 * @param bool $enable Whether to enable caching
	 *
	 * @return self
	 */
	public function set_cache_enabled( bool $enable ): self {
		$this->cache_settings['enabled'] = $enable;

		return $this;
	}

	/**
	 * Get cache status
	 *
	 * @return bool
	 */
	public function is_cache_enabled(): bool {
		return $this->cache_settings['enabled'];
	}

	/**
	 * Set cache expiration time
	 *
	 * @param int $seconds Cache expiration time in seconds
	 *
	 * @return self|WP_Error
	 */
	public function set_cache_expiration( int $seconds ) {
		if ( $seconds < 0 ) {
			return new WP_Error(
				'invalid_expiration',
				__( 'Cache expiration time cannot be negative', 'arraypress' )
			);
		}
		$this->cache_settings['expiration'] = $seconds;

		return $this;
	}

	/**
	 * Get cache expiration time in seconds
	 *
	 * @return int
	 */
	public function get_cache_expiration(): int {
		return $this->cache_settings['expiration'];
	}

	/**
	 * Get all cache settings
	 *
	 * @return array Current cache settings
	 */
	public function get_cache_settings(): array {
		return $this->cache_settings;
	}

	/** Options ******************************************************************/

	/**
	 * Enable or disable USPS CASS validation
	 *
	 * @param bool $enable Whether to enable USPS CASS validation
	 *
	 * @return self
	 */
	public function set_usps( bool $enable = true ): self {
		$this->options['enable_usps'] = $enable;

		return $this;
	}

	/**
	 * Check if USPS CASS validation is enabled
	 *
	 * @return bool
	 */
	public function get_usps(): bool {
		return (bool) $this->options['enable_usps'];
	}

	/**
	 * Set language options for validation
	 *
	 * @param array|string $options Language options array or language code
	 *
	 * @return self
	 */
	public function set_language_options( $options ): self {
		if ( is_string( $options ) ) {
			$options = [ 'languageCode' => $options ];
		}
		$this->options['language_options'] = $options;

		return $this;
	}

	/**
	 * Get current language options
	 *
	 * @return array|string|null
	 */
	public function get_language_options() {
		return $this->options['language_options'];
	}

	/**
	 * Set previous response ID for sequential validation
	 *
	 * @param string $response_id Previous response ID
	 *
	 * @return self
	 */
	public function set_previous_response( string $response_id ): self {
		$this->options['previous_response'] = $response_id;

		return $this;
	}

	/**
	 * Get current previous response ID
	 *
	 * @return string|null
	 */
	public function get_previous_response(): ?string {
		return $this->options['previous_response'];
	}

	/**
	 * Set session token for billing purposes
	 *
	 * @param string $token Session token
	 *
	 * @return self
	 */
	public function set_session_token( string $token ): self {
		$this->options['session_token'] = $token;

		return $this;
	}

	/**
	 * Get current session token
	 *
	 * @return string|null
	 */
	public function get_session_token(): ?string {
		return $this->options['session_token'];
	}

	/**
	 * Get current validation options
	 *
	 * @return array Current options
	 */
	public function get_all_options(): array {
		return array_filter( $this->options, fn( $value ) => $value !== null );
	}

	/** Reset ********************************************************************/

	/**
	 * Reset all validation options to defaults
	 *
	 * @return self
	 */
	public function reset_options(): self {
		$this->options = [
			'enable_usps'       => false,
			'language_options'  => null,
			'previous_response' => null,
			'session_token'     => null
		];

		return $this;
	}

}