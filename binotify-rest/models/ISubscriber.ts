export interface ISubscriber {
	creatorId: string | number;
	creatorUsername?: string | undefined | null;
	creatorName?: string | undefined | null;
	subscriberId: string | number;
	subscriberUsername?: string | undefined | null;
	subscriberName?: string | undefined | null;
	status: string;
}
