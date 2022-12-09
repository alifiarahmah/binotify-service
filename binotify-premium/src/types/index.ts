export interface ISubscriber {
	creatorId: string | number;
	creatorUsername?: string | undefined | null;
	creatorName?: string | undefined | null;
	subscriberId: string | number;
	subscriberUsername?: string | undefined | null;
	subscriberName?: string | undefined | null;
	status: string;
}

export interface ISong {
	penyanyi_id: string | number;
	creatorUsername?: string | undefined | null;
	creatorName?: string | undefined | null;
	song_id: string | number;
	song_title: string;
	audio_path: string;
}