New enquiry received from the GISBA Consultants website.
------------------------------------------------------------

Name:         {{ $name }}
Email:        {{ $email }}
Phone:        {{ $phone ?: 'Not provided' }}
Organization: {{ $organization ?: 'Not provided' }}
Service:      {{ $serviceLabel }}
Heard From:   {{ $heardFromLabel }}

Message:
{{ $body }}

------------------------------------------------------------
Sent: {{ now()->format('Y-m-d H:i:s T') }}
