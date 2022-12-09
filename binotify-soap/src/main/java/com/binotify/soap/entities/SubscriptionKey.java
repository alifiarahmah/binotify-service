package com.binotify.soap.entities;

import java.io.Serializable;

public class SubscriptionKey implements Serializable {
    private long creatorId;
    private long subscriberId;

    // constructor
    public SubscriptionKey() {

    }

    public SubscriptionKey(long creatorId, long subscriberId) {
        this.creatorId = creatorId;
        this.subscriberId = subscriberId;
    }

    // getter
    public long getCreatorId() {
        return creatorId;
    }

    public long getSubscriberId() {
        return subscriberId;
    }

    // setter
    public void setCreatorId(long creatorId) {
        this.creatorId = creatorId;
    }

    public void setSubscriberId(long subscriberId) {
        this.subscriberId = subscriberId;
    }
}
