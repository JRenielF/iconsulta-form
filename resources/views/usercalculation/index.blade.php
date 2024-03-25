@extends('layouts.calculation')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Service Inquiry Form') }}</div>

                <div class="card-body">
                    <form id="calculationForm" method="POST" action="{{ route('usercalculation.calculate') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="service_company" class="col-md-4 col-form-label text-md-right">{{ __('Service and Company') }}</label>

                            <div class="col-md-6">
                                <select id="service_company" class="form-control @error('service_company') is-invalid @enderror" name="service_company" required autofocus>
                                    <option value="" disabled selected>Select a service and company</option>
                                    <!-- Service 1 Options -->
                                    <optgroup label="iHome">
                                        <option value="service1_company1" data-price="10">Airbnb</option>
                                        <option value="service1_company2" data-price="15">Vrbo</option>
                                        <option value="service1_company3" data-price="16">Booking.com</option>
                                    </optgroup>
                                    <!-- Service 2 Options -->
                                    <optgroup label="iMoveU">
                                        <option value="service2_company1" data-price="20">Company 1</option>
                                        <option value="service2_company2" data-price="25">Company 2</option>
                                        <option value="service2_company3" data-price="30">Company 3</option>
                                    </optgroup>
                                    <!-- Add more options as needed -->
                                </select>

                                @error('service_company')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Nested dropdown for Airbnb options -->
                        <div class="form-group row" id="airbnb_options" style="display: none;">
                            <label for="airbnb_hotel" class="col-md-4 col-form-label text-md-right">{{ __('Select Airbnb Hotel') }}</label>

                            <div class="col-md-6">
                                <select id="airbnb_hotel" class="form-control">
                                    <option value="" disabled selected>Select Airbnb hotel</option>
                                    <option value="luxury_hotel" data-price="80">Luxury Hotel</option>
                                    <option value="boutique_hotel" data-price="60">Boutique Hotel</option>
                                </select>
                            </div>
                        </div>

                        <!-- Quantity Field -->
                        <div class="form-group row">
                            <label for="quantity" class="col-md-4 col-form-label text-md-right">{{ __('Quantity') }}</label>

                            <div class="col-md-6">
                                <input id="quantity" type="number" class="form-control @error('quantity') is-invalid @enderror" name="quantity" value="{{ old('quantity') }}" required>

                                @error('quantity')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Computation Field -->
                        <div class="form-group row">
                            <label for="total_cost" class="col-md-4 col-form-label text-md-right">{{ __('Total Cost') }}</label>

                            <div class="col-md-6">
                                <input id="total_cost" type="text" class="form-control" name="total_cost" readonly>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Submit Inquiry') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript to Perform Computation and Toggle Nested Dropdown -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var quantityInput = document.getElementById('quantity');
        var serviceCompanySelect = document.getElementById('service_company');
        var airbnbOptionsDiv = document.getElementById('airbnb_options');
        var airbnbHotelSelect = document.getElementById('airbnb_hotel');
        var totalCostInput = document.getElementById('total_cost');

        quantityInput.addEventListener('input', computeTotalCost);
        serviceCompanySelect.addEventListener('change', toggleNestedDropdown);
        airbnbHotelSelect.addEventListener('change', computeTotalCost);

        function toggleNestedDropdown() {
            var selectedService = serviceCompanySelect.value;
            if (selectedService === 'service1_company1') {
                airbnbOptionsDiv.style.display = 'block';
            } else {
                airbnbOptionsDiv.style.display = 'none';
            }
        }

        function computeTotalCost() {
            var quantity = parseFloat(quantityInput.value);
            var selectedOption = serviceCompanySelect.options[serviceCompanySelect.selectedIndex];
            var servicePrice = parseFloat(selectedOption.dataset.price);

            var totalCost = quantity * servicePrice;

            if (airbnbOptionsDiv.style.display === 'block') {
                var selectedHotelOption = airbnbHotelSelect.options[airbnbHotelSelect.selectedIndex];
                var hotelPrice = parseFloat(selectedHotelOption.dataset.price);
                totalCost += quantity * hotelPrice;
            }

            totalCostInput.value = isNaN(totalCost) ? '' : totalCost.toFixed(2);
        }
    });
</script>
@endsection
