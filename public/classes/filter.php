<?php
/**
 * Form data validation, sanitization.
 *
 * @link       https://abmsourav.com/
 *
 * @package    talash
 * @author     sourav926 
 */
namespace Talash\View;


class Filter {

	private $result = [];

	public static function data_sanitization($data) {
		if ( ! is_object( $data ) ) return false;

		$sanitized_data = [];
		foreach ( $data as $key => $item ) {
			$item = sanitize_text_field( $item );
			if ( $item ) {
				if ( $key === 'catID' || $key === 'authorID' ) {
					$sanitized_data[$key] = self::number_sanitization($item);
				} elseif ( $key === 'talashKey' || $key === 'postType' || $key === 'dateRangeStart' || $key === 'dateRangeEnd' ) {
					$sanitized_data[$key] = self::string_sanitization($item);
				} else return $sanitized_data = false;
			} else {
				$sanitized_data[$key] = '';
			}
		}

		return (object)$sanitized_data;
	}

	public static function check_validation($data) {
		if ( ! is_object( $data ) ) return false;

		$self = new self;
		foreach ( $data as $key => $input_data ) {
			if ( $input_data === null || ! is_string( $input_data ) ) {
				return false;
			}

			if ( $key == 'talashKey' || $key == 'postType' ) {
				$self->string_check( $input_data, $key );
				if ( ! $self->result ) return false;
			}
			if ( $key == 'catID' || $key == 'authorID' ) {
				$self->number_check( $input_data, $key );
				if ( ! $self->result ) return false;
			} 
			if ( $key == 'dateRangeStart' || $key == 'dateRangeEnd' ) {
				$self->date_check( $input_data, $key );
				if ( ! $self->result ) return false;
			}
		}

		if ( empty( $self->result ) ) {
			return false;
		}
		return (object)$self->result;
	}

	private static function number_sanitization($data) {
		$data = explode( ', ', $data );
		$arr = [];

		foreach ( $data as $elm ) {
			array_push( $arr, filter_var( $elm, FILTER_SANITIZE_NUMBER_INT ) );
		}
		return implode( ', ', $arr );
	}

	private static function string_sanitization($data) {
		$data = explode( ', ', $data );
		$arr = [];

		foreach ( $data as $elm ) {
			array_push( $arr, filter_var( $elm, FILTER_SANITIZE_STRING ) );
		}
		return implode( ', ', $arr );
	}

	private function string_check($string, $key) {
		if ( $string != '' ) {
			if ( $key == 'postType' ) {
				$string_arr = [];
				$strings = explode( ', ', $string );
	
				foreach ( $strings as $str ) {
					if ( ! is_string($str) ) return $this->result = false;
					array_push( $string_arr, $str );
				}
				return $this->result[$key] = implode( ', ', $string_arr );
			} else return $this->result[$key] = $string;
		} else $this->result[$key] = '';
	}

	private function number_check($number, $key) {
		if ( $number != '' ) {
			$arr_ids = [];
			$ids = explode(', ', $number);
			foreach ( $ids as $id ) {
				if ( ! intval($id) ) return $this->result = false;
				array_push($arr_ids, intval($id));
			}
			return $this->result[$key] = implode( ', ', $arr_ids );
		} else $this->result[$key] = '';
	}

	private function date_validator($date) {
		$format = 'Y-m-j H:i:s';

		$d = \DateTime::createFromFormat($format, $date);
    	return $d && $d->format($format) == $date;
	}

	private function date_check($date, $key) {
		if ( ! $this->date_validator( $date ) ) {
			return $this->result = false;
		}

		return $this->result[$key] = $date;
	}

}
