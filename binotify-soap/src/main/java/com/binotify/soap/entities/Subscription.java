package com.binotify.soap.entities;

import com.binotify.soap.enums.Status;
import jakarta.persistence.*;

@Entity
@Table(name="subscription")
@IdClass(SubscriptionKey.class)
public class Subscription {
    @Id
    private long creatorId;
    @Id
    private long subscriberId;
    @Enumerated(EnumType.STRING)
    private Status status;

    // getter
    public long getCreatorId() {
        return creatorId;
    }

    public long getSubscriberId() {
        return subscriberId;
    }

    public Status getStatus() {
        return status;
    }

    // setter
    public void setCreatorId(long creatorId) {
        this.creatorId = creatorId;
    }

    public void setSubscriberId(long subscriberId) {
        this.subscriberId = subscriberId;
    }

    public void setStatus(Status status) {
        this.status = status;
    }

    // constructor
    public Subscription() {
        super();
    }

    // String representation
    @Override
    public String toString() {
        return "Subscription[creatorId=" + this.creatorId + ", subscriberId=" + this.subscriberId + ", status=" + this.status.toString() + "]";
    }
}
