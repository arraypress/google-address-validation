<?php
/**
 * Google Address Validation API Response Class
 *
 * @package     ArrayPress/Utils
 * @copyright   Copyright (c) 2024, ArrayPress Limited
 * @license     GPL2+
 * @version     1.0.0
 * @author      David Sherlock
 */

declare( strict_types=1 );

namespace ArrayPress\Google\AddressValidation;

/**
 * Class Response
 *
 * Handles and structures the response data from Google Address Validation API.
 */
class Response {

	/**
	 * Raw response data from the API
	 *
	 * @var array
	 */
	private array $data;

	/**
	 * Initialize the response object
	 *
	 * @param array $data Raw response data from Address Validation API
	 */
	public function __construct( array $data ) {
		$this->data = $data;
	}

	/**
	 * Get raw data array
	 *
	 * @return array
	 */
	public function get_all(): array {
		return $this->data;
	}

	/**
	 * Get the response ID
	 *
	 * @return string|null
	 */
	public function get_response_id(): ?string {
		return $this->data['responseId'] ?? null;
	}

	/**
	 * Get verdict information
	 *
	 * @return array|null
	 */
	public function get_verdict(): ?array {
		return $this->data['result']['verdict'] ?? null;
	}

	/**
	 * Get input granularity level
	 *
	 * @return string|null
	 */
	public function get_input_granularity(): ?string {
		return $this->data['result']['verdict']['inputGranularity'] ?? null;
	}

	/**
	 * Get validation granularity level
	 *
	 * @return string|null
	 */
	public function get_validation_granularity(): ?string {
		return $this->data['result']['verdict']['validationGranularity'] ?? null;
	}

	/**
	 * Get geocode granularity level
	 *
	 * @return string|null
	 */
	public function get_geocode_granularity(): ?string {
		return $this->data['result']['verdict']['geocodeGranularity'] ?? null;
	}

	/**
	 * Check if address is complete
	 *
	 * @return bool
	 */
	public function is_address_complete(): bool {
		return $this->data['result']['verdict']['addressComplete'] ?? false;
	}

	/**
	 * Check if address has unconfirmed components
	 *
	 * @return bool
	 */
	public function has_unconfirmed_components(): bool {
		return $this->data['result']['verdict']['hasUnconfirmedComponents'] ?? false;
	}

	/**
	 * Check if address has inferred components
	 *
	 * @return bool
	 */
	public function has_inferred_components(): bool {
		return $this->data['result']['verdict']['hasInferredComponents'] ?? false;
	}

	/**
	 * Check if address has replaced components
	 *
	 * @return bool
	 */
	public function has_replaced_components(): bool {
		return $this->data['result']['verdict']['hasReplacedComponents'] ?? false;
	}

	/**
	 * Get formatted address
	 *
	 * @return string|null
	 */
	public function get_formatted_address(): ?string {
		return $this->data['result']['address']['formattedAddress'] ?? null;
	}

	/**
	 * Get postal address object
	 *
	 * @return array|null
	 */
	public function get_postal_address(): ?array {
		return $this->data['result']['address']['postalAddress'] ?? null;
	}

	/**
	 * Get address components
	 *
	 * @return array
	 */
	public function get_address_components(): array {
		return $this->data['result']['address']['addressComponents'] ?? [];
	}

	/**
	 * Get specific address component
	 *
	 * @param string $type Component type to retrieve
	 *
	 * @return array|null Component data or null if not found
	 */
	public function get_address_component( string $type ): ?array {
		foreach ( $this->get_address_components() as $component ) {
			if ( $component['componentType'] === $type ) {
				return $component;
			}
		}

		return null;
	}

	/**
	 * Get missing component types
	 *
	 * @return array
	 */
	public function get_missing_component_types(): array {
		return $this->data['result']['address']['missingComponentTypes'] ?? [];
	}

	/**
	 * Get unconfirmed component types
	 *
	 * @return array
	 */
	public function get_unconfirmed_component_types(): array {
		return $this->data['result']['address']['unconfirmedComponentTypes'] ?? [];
	}

	/**
	 * Get unresolved tokens
	 *
	 * @return array
	 */
	public function get_unresolved_tokens(): array {
		return $this->data['result']['address']['unresolvedTokens'] ?? [];
	}

	/**
	 * Get geocode data
	 *
	 * @return array|null
	 */
	public function get_geocode(): ?array {
		$location = $this->data['result']['geocode']['location'] ?? null;
		if ( $location ) {
			return [
				'latitude'  => $location['latitude'] ?? null,
				'longitude' => $location['longitude'] ?? null
			];
		}

		return null;
	}

	/**
	 * Get plus code
	 *
	 * @return array|null
	 */
	public function get_plus_code(): ?array {
		return $this->data['result']['geocode']['plusCode'] ?? null;
	}

	/**
	 * Get viewport bounds
	 *
	 * @return array|null
	 */
	public function get_viewport(): ?array {
		return $this->data['result']['geocode']['bounds'] ?? null;
	}

	/**
	 * Get feature size in meters
	 *
	 * @return float|null
	 */
	public function get_feature_size_meters(): ?float {
		return $this->data['result']['geocode']['featureSizeMeters'] ?? null;
	}

	/**
	 * Get place ID
	 *
	 * @return string|null
	 */
	public function get_place_id(): ?string {
		return $this->data['result']['geocode']['placeId'] ?? null;
	}

	/**
	 * Get place types
	 *
	 * @return array
	 */
	public function get_place_types(): array {
		return $this->data['result']['geocode']['placeTypes'] ?? [];
	}

	/**
	 * Get address metadata
	 *
	 * @return array|null
	 */
	public function get_metadata(): ?array {
		return $this->data['result']['metadata'] ?? null;
	}

	/**
	 * Check if address is a business
	 *
	 * @return bool
	 */
	public function is_business(): bool {
		return $this->data['result']['metadata']['business'] ?? false;
	}

	/**
	 * Check if address is a PO Box
	 *
	 * @return bool
	 */
	public function is_po_box(): bool {
		return $this->data['result']['metadata']['poBox'] ?? false;
	}

	/**
	 * Check if address is residential
	 *
	 * @return bool
	 */
	public function is_residential(): bool {
		return $this->data['result']['metadata']['residential'] ?? false;
	}

	/**
	 * Get USPS data
	 *
	 * @return array|null
	 */
	public function get_usps_data(): ?array {
		return $this->data['result']['uspsData'] ?? null;
	}

	/**
	 * Get USPS standardized address
	 *
	 * @return array|null
	 */
	public function get_usps_standardized_address(): ?array {
		return $this->data['result']['uspsData']['standardizedAddress'] ?? null;
	}

	/**
	 * Get delivery point code
	 *
	 * @return string|null
	 */
	public function get_delivery_point_code(): ?string {
		return $this->data['result']['uspsData']['deliveryPointCode'] ?? null;
	}

	/**
	 * Get carrier route
	 *
	 * @return string|null
	 */
	public function get_carrier_route(): ?string {
		return $this->data['result']['uspsData']['carrierRoute'] ?? null;
	}

	/**
	 * Check if address is a Commercial Mail Receiving Agency
	 *
	 * @return bool
	 */
	public function is_commercial_mail_receiver(): bool {
		return ( $this->data['result']['uspsData']['dpvCmra'] ?? '' ) === 'Y';
	}

	/**
	 * Check if address is vacant
	 *
	 * @return bool
	 */
	public function is_vacant(): bool {
		return ( $this->data['result']['uspsData']['dpvVacant'] ?? '' ) === 'Y';
	}

	/**
	 * Check if address is active
	 *
	 * @return bool
	 */
	public function is_active(): bool {
		return ( $this->data['result']['uspsData']['dpvNoStat'] ?? '' ) === 'N';
	}

	/**
	 * Get DPV confirmation status
	 *
	 * @return string|null
	 */
	public function get_dpv_confirmation(): ?string {
		return $this->data['result']['uspsData']['dpvConfirmation'] ?? null;
	}

	/**
	 * Get English Latin Address (if requested)
	 *
	 * @return array|null
	 */
	public function get_english_latin_address(): ?array {
		return $this->data['result']['englishLatinAddress'] ?? null;
	}

	/**
	 * Get complete standardized address components
	 *
	 * @return array Structured address components
	 */
	public function get_standardized_address(): array {
		$postal = $this->get_postal_address();

		return [
			'address_lines'       => $postal['addressLines'] ?? [],
			'administrative_area' => $postal['administrativeArea'] ?? null,
			'language_code'       => $postal['languageCode'] ?? null,
			'locality'            => $postal['locality'] ?? null,
			'postal_code'         => $postal['postalCode'] ?? null,
			'region_code'         => $postal['regionCode'] ?? null,
			'sorting_code'        => $postal['sortingCode'] ?? null,
			'sublocality'         => $postal['sublocality'] ?? null,
			'formatted_address'   => $this->get_formatted_address()
		];
	}

}