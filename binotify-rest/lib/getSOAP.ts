import soapRequest from 'easy-soap-request';

export async function getSOAP(
	url: string,
	req_header: Object,
	req_body: string
) {
	const { response } = await soapRequest({
		url: `${process.env.SOAP_BASE_URL}${url}`,
		headers: {
			'Content-Type': 'text/xml',
			...req_header,
		},
		xml: `<?xml version="1.0" encoding="utf-8"?>
			<s:Envelope xmlns:s="http://schemas.xmlsoap.org/soap/envelope/"
			xmlns:m="http://soap.binotify.com/">
					<s:Body>
							${req_body}
					</s:Body>
			</s:Envelope>`,
		timeout: 10000,
	});
	const { headers, body, statusCode } = response;
	return {
		headers,
		body,
		statusCode,
	};
}
