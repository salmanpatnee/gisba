<?php

it('loads the home page', function () {
    $this->get(route('home'))->assertSuccessful()->assertSee('GISBA');
});

it('loads the NIS2 toolkit page', function () {
    $this->get(route('nis2'))->assertSuccessful()->assertSee('NIS2');
});

it('loads the training course development page', function () {
    $this->get(route('training'))->assertSuccessful()->assertSee('Training');
});

it('loads the success stories page', function () {
    $this->get(route('success-stories'))->assertSuccessful()->assertSee('Success');
});

it('loads the contact us page', function () {
    $this->get(route('contact-us'))->assertSuccessful()->assertSee('Contact');
});

it('loads the privacy policy page', function () {
    $this->get(route('privacy-policy'))->assertSuccessful()->assertSee('Privacy');
});

it('loads the digital delivery policy page', function () {
    $this->get(route('digital-delivery-policy'))->assertSuccessful()->assertSee('Delivery');
});

it('loads the digital refund policy page', function () {
    $this->get(route('digital-refund-policy'))->assertSuccessful()->assertSee('Refund');
});

it('loads the terms of use page', function () {
    $this->get(route('terms-of-use'))->assertSuccessful()->assertSee('Terms');
});
