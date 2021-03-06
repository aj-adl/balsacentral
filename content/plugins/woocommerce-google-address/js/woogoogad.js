/*
* License: http://codecanyon.net/licenses/regular_extended
* http://codecanyon.net/item/google-address-autocomplete-for-woocommerce/7208221?ref=mbcreation
version 1.8
*/

jQuery(function($) {
	$(document).ready(function(){
		
		
		var woogoogad_debug = false;
		
		var enabled_on_shipping_address = true;
		if(!woogoogad.enabled_on_shipping_address)
			enabled_on_shipping_address = false;
			
		var enabled_on_billing_address = true;
		if(!woogoogad.enabled_on_billing_address)
			enabled_on_billing_address = false;
			
		if(enabled_on_shipping_address)
		{
			var shipping_address_google = document.getElementById('shipping_address_google');
		}
		
		if(enabled_on_billing_address)
		{
			var billing_address_google = document.getElementById('billing_address_google');
		}
		
		if((enabled_on_billing_address && !billing_address_google) || (enabled_on_shipping_address && !shipping_address_google) )
		{
			if(enabled_on_billing_address && !billing_address_google)
			{
				console.log('You don\'t have the required field #billing_address_google. Please refer to FAQ : http://codecanyon.net/item/google-address-autocomplete-for-woocommerce/7208221/support');
				enabled_on_billing_address = false;
				woogoogad.enabled_on_billing_address = false;
			}
			
				
			if(enabled_on_shipping_address && !shipping_address_google)
			{
				console.log('You don\'t have the required field #shipping_address_google. Please refer to FAQ : http://codecanyon.net/item/google-address-autocomplete-for-woocommerce/7208221/support');
				enabled_on_shipping_address = false;
				woogoogad.enabled_on_shipping_address = false;
			}
				
		}
		
		
		if(!enabled_on_billing_address)
			$('#billing_address_google').closest('p').remove();
		
				
		if(!enabled_on_shipping_address)
			$('#shipping_address_google').closest('p').remove();
			
		
		if( enabled_on_billing_address || enabled_on_shipping_address)
		{
		
			if(typeof wc_address_i18n_params !== 'undefined')
				var woogoogad_locale_json = wc_address_i18n_params.locale.replace( /&quot;/g, '"' );
			else
				var woogoogad_locale_json = woocommerce_params.locale.replace( /&quot;/g, '"' );
		
			var woogoogad_locale = $.parseJSON( woogoogad_locale_json );
		
			if(enabled_on_billing_address)
			{				
				//safari's trick to prevent loading contact box above google suggest
				$('#billing_address_google').removeAttr('name');
				$('#billing_address_google').removeAttr('id');
				
			}
			
			if(enabled_on_shipping_address)
			{
				$('#shipping_address_google').removeAttr('name');
				$('#shipping_address_google').removeAttr('id');
			}
			
			if(enabled_on_billing_address)
			{
				//group the billing address fields
				$(billing_address_google).closest('p').after('<div class="details_billing"></div>');
				$(billing_address_google).after('<a href="#" id="billing_address_not_found">'+woogoogad.billing_address_not_found_label+'</a>');
		
				for(i=0; i<woogoogad.billing_fields_to_group.length;i++)
				{			$('#'+woogoogad.billing_fields_to_group[i]).closest('p').appendTo('.details_billing');
				}
				$('<div class="clear"></div>').appendTo('.details_billing');
		
		
				for(i=woogoogad.billing_fields_to_put_after_address.length-1; i>=0;i--)
				{
					$('.details_billing').after($('#'+woogoogad.billing_fields_to_put_after_address[i]));
				}
			}
			
			//group the shipping address fields
			if(enabled_on_shipping_address)
			{
				$(shipping_address_google).closest('p').after('<div class="details_shipping"></div>');
				$(shipping_address_google).after('<a href="#" id="shipping_address_not_found">'+woogoogad.shipping_address_not_found_label+'</a>');
		
				for(i=0; i<woogoogad.shipping_fields_to_group.length;i++)
				{			$('#'+woogoogad.shipping_fields_to_group[i]).closest('p').appendTo('.details_shipping');
				}
				$('<div class="clear"></div>').appendTo('.details_shipping');
		
				for(i=woogoogad.shipping_fields_to_put_after_address.length-1; i>=0;i--)
				{			$('.details_shipping').after($('#'+woogoogad.shipping_fields_to_put_after_address[i]));
				}
			}
		
			if(enabled_on_billing_address)
			{
				//hide the address fields
				$('#billing_address_not_found').hide();
			}
			
			if(enabled_on_shipping_address)
			{
				$('#shipping_address_not_found').hide();
			}
			
			if($('.woocommerce-error').length==0)
			{
				if(enabled_on_billing_address)
				{
					if( ($('#billing_address_1').val() == '') || (! (document.getElementById('billing_address_1')) && ($(billing_address_google).val() == '' ) ) )
					{
						$('.details_billing').hide();
						$('#billing_address_not_found').show();
					}
					else
					{
						woogoogad_autoremplissageGoogleAddress('billing', billing_address_google);
				
						if(woogoogad.hideAddressFieldsForReturningCustomers)
						{
							$('.details_billing').hide();
							$('#billing_address_not_found').show();
						}
				
					}
				}
				if(enabled_on_shipping_address)
				{
					if($('#shipping_address_1').val() == '' || (!document.getElementById('shipping_address_1') && $(shipping_address_google).val() == '') )
					{
						$('.details_shipping').hide();
						$('#shipping_address_not_found').show();
					}
					else
					{
						woogoogad_autoremplissageGoogleAddress('shipping', shipping_address_google);
				
						if(woogoogad.hideAddressFieldsForReturningCustomers)
						{
							$('.details_shipping').hide();
							$('#shipping_address_not_found').show();
						}
					}
				}
			}
	   
	   		if(enabled_on_billing_address)
			{
				woogoogad_reordering_fields('billing');
			}
			
			if(enabled_on_shipping_address)
			{
				woogoogad_reordering_fields('shipping');
			}
	   
	   
	   		if(enabled_on_billing_address)
			{
				//prevent chrome autofill
				$(billing_address_google).focus(function(e){
					$(billing_address_google).attr('autocomplete', 'cc-additional-name');
				});
				
				
				//prevent submiting form if validate the address by pressing enter key
				$(billing_address_google).keydown(function(e){
					if(e.keyCode == 13)
					{
						e.preventDefault();
					}
				});
			}
			
			if(enabled_on_shipping_address)
			{
				//prevent chrome autofill
				$(shipping_address_google).focus(function(e){
					$(shipping_address_google).attr('autocomplete', 'cc-additional-name');
				});
				
				$(shipping_address_google).keydown(function(e){
					if(e.keyCode == 13)
					{
						e.preventDefault();
					}
				});
			}
		
			if(enabled_on_billing_address)
			{
			//show the hidden fields manually
				$('#billing_address_not_found').click(function(e){
					e.preventDefault();
					$('#billing_address_not_found').hide();
					$('.details_billing').slideDown();
				});
			}
			
			if(enabled_on_shipping_address)
			{
				$('#shipping_address_not_found').click(function(e){
					e.preventDefault();
					$('#shipping_address_not_found').hide();
					$('.details_shipping').slideDown();
				});
			}
		
			//google places initialization
			woogoogad_initialize();


			var placeSearch;
			
			if(enabled_on_billing_address)
			{
				var autocomplete_billing;
			}
			
			if(enabled_on_shipping_address)
			{
				var autocomplete_shipping;
			}
		
			//addresses components to retrieve	
		
			/* available keys
			street_address
			route
			intersection
			political
			country
			administrative_area_level_1
			administrative_area_level_2
			administrative_area_level_3
			administrative_area_level_4
			administrative_area_level_5
			colloquial_area
			locality
			sublocality
			neighborhood
			premise
			subpremise
			postal_code
			natural_feature
			airport
			park
			*/
			
			var componentForm = {
				street_number: 'short_name',
				route: 'long_name',
				locality: 'long_name',
				administrative_area_level_1: 'short_name',
				administrative_area_level_2: 'short_name',
				administrative_area_level_3: 'long_name',
				country: 'short_name',
				postal_code: 'short_name',
				postal_town: 'long_name',
				subpremise: 'short_name',
				neighborhood: 'long_name',
			};
			

			if(enabled_on_billing_address)
			{
				$(document).on('change', '#billing_address_1, #billing_address_2, #billing_city, #billing_state, #billing_postcode, #billing_country', function(){

					woogoogad_autoremplissageGoogleAddress('billing', billing_address_google);
				});
			}
		
			if(enabled_on_shipping_address)
			{
				$(document).on('change', '#shipping_address_1, #shipping_address_2, #shipping_city, #shipping_state, #shipping_postcode, #shipping_country', function(){
					woogoogad_autoremplissageGoogleAddress('shipping', shipping_address_google);
				});
			}

			
	}
	
		function debug(place)
		{
			/* available keys https://developers.google.com/maps/documentation/javascript/geocoding
			street_address
			route
			intersection
			political
			country
			administrative_area_level_1
			administrative_area_level_2
			administrative_area_level_3
			administrative_area_level_4
			administrative_area_level_5
			colloquial_area
			locality
			sublocality
			neighborhood
			premise
			subpremise
			postal_code
			natural_feature
			airport
			park
			*/
			
			var componentFormShortNames = {
				street_number: 'short_name',
				route: 'short_name',
				intersection: 'short_name',
				political: 'short_name',
				country: 'short_name',
				administrative_area_level_1: 'short_name',
				administrative_area_level_2: 'short_name',
				administrative_area_level_3: 'short_name',
				administrative_area_level_4: 'short_name',
				administrative_area_level_5: 'short_name',
				colloquial_area: 'short_name',
				locality: 'short_name',
				sublocality: 'short_name',
				neighborhood: 'short_name',
				premise: 'short_name',
				subpremise: 'short_name',
				postal_town: 'short_name',
				postal_code: 'short_name',
				natural_feature: 'short_name',
				airport: 'short_name',
				park: 'short_name'
			};
			
			
			var componentFormLongNames = {
				street_number: 'long_name',
				route: 'long_name',
				intersection: 'long_name',
				political: 'long_name',
				country: 'long_name',
				administrative_area_level_1: 'long_name',
				administrative_area_level_2: 'long_name',
				administrative_area_level_3: 'long_name',
				administrative_area_level_4: 'long_name',
				administrative_area_level_5: 'long_name',
				colloquial_area: 'long_name',
				locality: 'long_name',
				sublocality: 'long_name',
				neighborhood: 'long_name',
				premise: 'long_name',
				subpremise: 'long_name',
				postal_town: 'long_name',
				postal_code: 'long_name',
				natural_feature: 'long_name',
				airport: 'long_name',
				park: 'long_name'
			};
			
			if(place.address_components != undefined)
			{
				for (var i = 0; i < place.address_components.length; i++) {
					var addressType = place.address_components[i].types[0];
	
					if (componentFormShortNames[addressType]) {
						var val = place.address_components[i][componentFormShortNames[addressType]];
						console.log(addressType+' (short) - '+val);
					}
					
					if (componentFormLongNames[addressType]) {
						var val2 = place.address_components[i][componentFormLongNames[addressType]];
						console.log(addressType+' (long) - '+val2);
					}
				}
			}
		}
	
		function woogoogad_initialize() 
		{
			if(woogoogad.enabled_on_billing_address)
			{
				// Create the autocomplete object for billing address, restricting the search
				// to geographical location types.
				autocomplete_billing = new google.maps.places.Autocomplete(
				(billing_address_google),
				{ types: ['geocode'] });
				// When the user selects an address from the dropdown,
				// populate the address fields in the form.
				google.maps.event.addListener(autocomplete_billing, 'place_changed', 
				function() {
					woogoogad_fillInAddress('billing');
				});
			}
			
			if(woogoogad.enabled_on_shipping_address)
			{
				// Create the autocomplete object for shipping address
				autocomplete_shipping = new google.maps.places.Autocomplete(
				(shipping_address_google),
				{ types: ['geocode'] });
				google.maps.event.addListener(autocomplete_shipping, 'place_changed', 
				function() {
					woogoogad_fillInAddress('shipping');
				});
			}
		} //woogoogad_initialize

		function woogoogad_fillInAddress(prefix) 
		{
		
			// Get the place details from the right autocomplete object.
			if(prefix=='billing')
				var place = autocomplete_billing.getPlace();
			else
				var place = autocomplete_shipping.getPlace();
				
			if(woogoogad_debug)
				debug(place);

			var street_number = '';
			var route = '';
			var locality = '';
			var administrative_area_level_1 = '';
			var administrative_area_level_2 = '';
			var administrative_area_level_3 = '';
			var country = '';
			var postal_code = '';
			var postal_town = '';
			var subpremise = '';
			var neighborhood = '';


			if(place.address_components != undefined)
			{
				// Get each component of the address from the place details
				// and fill the corresponding field on the form.
				for (var i = 0; i < place.address_components.length; i++) {
					var addressType = place.address_components[i].types[0];
		
					if (componentForm[addressType]) {
						var val = place.address_components[i][componentForm[addressType]];
						//console.log(addressType+' - '+val);
						val = $.trim(val);
			
						if(addressType=='street_number')
							street_number = val;

						if(addressType=='route')
							route = val;

						if(addressType=='locality')
							locality = val;

						if(addressType=='administrative_area_level_1')
							administrative_area_level_1 = val;
				
						if(addressType=='administrative_area_level_2')
							administrative_area_level_2 = val;
						
						if(addressType=='administrative_area_level_3')
							administrative_area_level_3 = val;

						if(addressType=='country')
							country = val;

						if(addressType=='postal_code')
							postal_code = val;
				
						if(addressType=='postal_town')
							postal_town = val;
				
						if(addressType=='subpremise')
							subpremise = val;
							
						if(addressType=='neighborhood')
							neighborhood = val;	
				
					}
				}

				//Handle the selected address only if the country is available
				if(woogoogad_SelectHasValue(prefix + '_country', country))
				{
					if(country == 'IT')
						postal_code = postal_code+' '+administrative_area_level_2;
		
					if(country == 'IE')
						postal_code = postal_town;
			
					if(country == 'GB' && locality=='')
						locality = postal_town;
						
					if(country == 'ES')
					{
						if(administrative_area_level_2)
							administrative_area_level_1 = administrative_area_level_2;
				
						if(administrative_area_level_1 == 'Sevilla')
							administrative_area_level_1 = 'SE';
						if(administrative_area_level_1 == 'Málaga')
							administrative_area_level_1 = 'MA';
						if(administrative_area_level_1 == 'Álava')
							administrative_area_level_1 = 'VI';
						if(administrative_area_level_1 == 'Albacete')
							administrative_area_level_1 = 'AB';
						if(administrative_area_level_1 == 'Principado de Asturias')
							administrative_area_level_1 = 'O';
						if(administrative_area_level_1 == 'Ávila')
							administrative_area_level_1 = 'AV';
						if(administrative_area_level_1 == 'Badajoz')
							administrative_area_level_1 = 'BA';
						if(administrative_area_level_1 == 'Islas Baleares')
							administrative_area_level_1 = 'PM';
						if(administrative_area_level_1 == 'Burgos')
							administrative_area_level_1 = 'BU';
						if(administrative_area_level_1 == 'Cáceres')
							administrative_area_level_1 = 'CC';
						if(administrative_area_level_1 == 'Cantabria')
							administrative_area_level_1 = 'S';
						if(administrative_area_level_1 == 'Castellón')
							administrative_area_level_1 = 'CS';
						if(administrative_area_level_1 == 'Cd Real')
							administrative_area_level_1 = 'CR';
						if(administrative_area_level_1 == 'Córdoba')
							administrative_area_level_1 = 'CO';
						if(administrative_area_level_1 == 'Cuenca')
							administrative_area_level_1 = 'CU';
						if(administrative_area_level_1 == 'Girona')
							administrative_area_level_1 = 'GI';
						if(administrative_area_level_1 == 'Granada')
							administrative_area_level_1 = 'GR';
						if(administrative_area_level_1 == 'Guadalajara')
							administrative_area_level_1 = 'GU';
						if(administrative_area_level_1 == 'Huelva')
							administrative_area_level_1 = 'H';
						if(administrative_area_level_1 == 'Huesca')
							administrative_area_level_1 = 'HU';
						if(administrative_area_level_1 == 'Jaén')
							administrative_area_level_1 = 'J';
						if(administrative_area_level_1 == 'La Rioja')
							administrative_area_level_1 = 'LO';
						if(administrative_area_level_1 == 'Las Palmas')
							administrative_area_level_1 = 'GC';
						if(administrative_area_level_1 == 'León')
							administrative_area_level_1 = 'LE';
						if(administrative_area_level_1 == 'Lleida')
							administrative_area_level_1 = 'L';	
						if(administrative_area_level_1 == 'Lugo')
							administrative_area_level_1 = 'LU';
						if(administrative_area_level_1 == 'Navarra')
							administrative_area_level_1 = 'NA';
						if(administrative_area_level_1 == 'Ourense')
							administrative_area_level_1 = 'OR';
						if(administrative_area_level_1 == 'Palencia')
							administrative_area_level_1 = 'P';
						if(administrative_area_level_1 == 'Soria')
							administrative_area_level_1 = 'SO';
						if(administrative_area_level_1 == 'Teruel')
							administrative_area_level_1 = 'TE';
						if(administrative_area_level_1 == 'Zamora')
							administrative_area_level_1 = 'ZA';
						
					}
					
					if(country == 'TW')
					{
						if(!locality && administrative_area_level_1)
							locality = administrative_area_level_1;

						if(!locality && administrative_area_level_2)
							locality = administrative_area_level_2;
						
						if(administrative_area_level_3)
							administrative_area_level_1 = administrative_area_level_3;
						
						temp = locality;
						locality = administrative_area_level_1;
						administrative_area_level_1 = temp;
					}
			
					if(country == 'GB' && administrative_area_level_2 != '')
						administrative_area_level_1 = administrative_area_level_2;
					
					if(country == 'GB' && administrative_area_level_1 == '')
						administrative_area_level_1 = administrative_area_level_2;
		
					if(subpremise)
						street_number = subpremise+' / '+street_number;
		
					//set the values into the woocommerce fields
					if(country == 'AU' || country == 'FR' || country == 'IN' || country == 'IE' || country == 'MY' || country == 'NZ' || country == 'PK' || country == 'SG' || country == 'LK' || country == 'TW' || country == 'TH' || country == 'GB' || country == 'US' || country == 'PH' || country == 'CA' )
					{
						if(document.getElementById(prefix + '_address_1'))
							document.getElementById(prefix + '_address_1').value = $.trim(street_number+' '+route);
					}
					else
					{
						if(document.getElementById(prefix + '_address_1'))
							document.getElementById(prefix + '_address_1').value = $.trim(route+' '+street_number);
					}
					
					if(document.getElementById(prefix + '_city'))
						document.getElementById(prefix + '_city').value = locality;
					
					if(document.getElementById(prefix + '_postcode'))
						document.getElementById(prefix + '_postcode').value = postal_code;
				
					if(document.getElementById(prefix + '_address_2'))
					{
						if(country != 'US')
							document.getElementById(prefix + '_address_2').value = neighborhood;
					}
				
					//trigger WooCommerce actions to refresh the form data
					$('#'+prefix+'_country').val(country)
						.trigger('liszt:updated').trigger('chosen:updated');
					$('.country_to_state').trigger('change');		
					$('#'+prefix+'_state').val(administrative_area_level_1)
						.trigger('liszt:updated').trigger('chosen:updated').trigger('change');
						
	
				}
				else
				{
					if(document.getElementById(prefix + '_address_1'))
						document.getElementById(prefix + '_address_1').value = '';
					if(document.getElementById(prefix + '_address_2'))
						document.getElementById(prefix + '_address_2').value = '';
					if(document.getElementById(prefix + '_city'))
						document.getElementById(prefix + '_city').value = '';
					if(document.getElementById(prefix + '_postcode'))
						document.getElementById(prefix + '_postcode').value = '';
				}
	
				$('.details_'+prefix).slideDown();
				$('#'+prefix+'_address_not_found').hide();
			}

		} //woogoogad_fillInAddress

		// Bias the autocomplete object to the user's geographical location,
		// as supplied by the browser's 'navigator.geolocation' object.
		function woogoogad_geolocate()
		{
			if (navigator.geolocation) {
				navigator.geolocation.getCurrentPosition(function(position) {
					var geolocation = new google.maps.LatLng(
					position.coords.latitude, position.coords.longitude);
					autocomplete.setBounds(new google.maps.LatLngBounds(geolocation,
					geolocation));
				});
			}
		} //woogoogad_geolocate

		//to test if the country of the selected address is available
		function woogoogad_SelectHasValue(select, value)
		{
			if($('#'+select).val() == value)
				return true;

			obj = document.getElementById(select);

			if (obj !== null) {
				return (obj.innerHTML.indexOf('value="' + value + '"') > -1 || obj.innerHTML.indexOf('value=' + value) > -1);
			} else {
				
				return (woogoogad.shop_base_location == value);
			}
		} //woogoogad_SelectHasValue


			
		function woogoogad_autoremplissageGoogleAddress(type, field)
		{
			country_val = $('#'+type+'_country').val();
			if ( typeof woogoogad_locale[ country_val ] !== 'undefined' ) {
				thislocale = woogoogad_locale[ country_val ];
			} else {
				thislocale = woogoogad_locale['default'];
			}
			
			var has_state = false;
			
			if((typeof thislocale !== 'undefined') && (typeof thislocale.state !== 'undefined') && thislocale.state.label)
				has_state = true;

			
			address1 = $('#'+type+'_address_1').val();
			address2 = $('#'+type+'_address_2').val();
			cp = $('#'+type+'_postcode').val();
			city = $('#'+type+'_city').val();
			
			if(has_state)
				state = $('#'+type+'_state').val();
			else
				state = '';
			country = $('#'+type+'_country').val();
			
			
			
			/*console.log('address1 :'+address1);
			console.log('address2 :'+address2);
			console.log('cp :'+cp);
			console.log('city :'+city);
			console.log('state :'+state);
			console.log('country :'+country);
			console.log('country_val :'+country_val);*/

			if($('#'+type+'_country').prop("tagName") == 'SELECT')
			{
				if(country!='')
					country = $('#'+type+'_country option:selected').text();
			}
			else
			{
				country = $('#'+type+'_country').prev('strong').text();
			}


			

			
			var address = '';
			if(city)
			{
				var address = address1;
				if(address2)
				{
					if(address)
						address += ', ';
					address += address2;
				}
			
				if(city && cp)
				{
					if ( thislocale.postcode_before_city )
					{
						if(address)
							address += ', ';
						
						address += $.trim(cp+' '+city);
					}
					else
					{
						if(address)
							address += ', ';
							
						address += $.trim(city+' '+cp);
					}
				}
				else
				{
					if(city)
					{
						if(address)
							address += ', ';
						address += $.trim(city);
					}
					if(cp)
					{
						if(address)
							address += ', ';
						address += $.trim(cp);
					}
				}
				
				if(state)
				{
					if(address)
						address += ', ';
					address += state;
				}
				
				if(country)
				{
					if(address)
						address += ', ';
					address += country;
				}
			}
			
			
			$(field).val(address);
		} //woogoogad_autoremplissageGoogleAddress


		/* reordering fields depending on country */
		function woogoogad_reordering_fields(type)
		{		
			var country = $('#'+type+'g').val();

			if ( typeof woogoogad_locale[ country ] !== 'undefined' ) {
				thislocale = woogoogad_locale[ country ];
			} else {
				thislocale = woogoogad_locale['default'];
			}

			$cityfield = $('#'+type+'_city_field');
			$postcodefield = $('#'+type+'_postcode_field');
			$statefield = $('#'+type+'_state_field');

			if ( thislocale.postcode_before_city ) {

				$postcodefield.add( $cityfield ).add( $statefield ).removeClass( 'form-row-first form-row-last' ).addClass( 'form-row-wide' );
				$postcodefield.insertBefore( $cityfield );

			} else {
				// Default
				$postcodefield.attr( 'class', $postcodefield.attr( 'data-o_class' ) );
				$cityfield.attr( 'class', $cityfield.attr( 'data-o_class' ) );
				$statefield.attr( 'class', $statefield.attr( 'data-o_class' ) );
				$postcodefield.insertAfter( $statefield );
			}

		}
			
	}); //document ready
	
	


}); //jQuery