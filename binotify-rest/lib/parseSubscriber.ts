import convert from 'xml-js';
import { ISubscriber } from '../models/ISubscriber';

export function parseSubscriber(xml: string) {
	const parsed_json = JSON.parse(convert.xml2json(xml)).elements[0].elements[0] // s:Envelope // s:Body
		.elements[0].elements[0].elements; // ns2:function // return // array of items

	const parsed_obj: ISubscriber[] = [];
	parsed_json.forEach(
		(
			item: {
				type: string;
				name: string;
				elements: any; // FIXME: type this
			},
			i: number
		) => {
			if (item.type === 'element') {
				const obj: ISubscriber = {
					creatorId: Number(item.elements[0].elements[0].text),
					status: item.elements[1].elements[0].text,
					subscriberId: Number(item.elements[2].elements[0].text),
				};
				parsed_obj.push(obj);
			}
		}
	);

	return parsed_obj;
}
