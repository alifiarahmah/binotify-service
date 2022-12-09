package com.binotify.soap.entities;

import jakarta.persistence.*;
import org.hibernate.annotations.CreationTimestamp;

import java.util.Date;

@Entity
@Table(name="logging")
public class Logging {
    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private int id;
    private String description;
    private String ip;
    private String endpoint;
    @CreationTimestamp
    @Column(name="requested_at", columnDefinition="TIMESTAMP DEFAULT CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP")
    @Temporal(TemporalType.TIMESTAMP)
    private Date requested_at;

    public Logging() {

    }

    public int getId() {
        return id;
    }

    public String getDescription() {
        return description;
    }

    public String getIp() {
        return ip;
    }

    public Date getRequested_at() {
        return requested_at;
    }

    public String getEndpoint() {
        return endpoint;
    }

    public void setId(int id) {
        this.id = id;
    }

    public void setDescription(String description) {
        this.description = description;
    }

    public void setIp(String ip) {
        this.ip = ip;
    }

    public void setEndpoint(String endpoint) {
        this.endpoint = endpoint;
    }

    public void setRequested_at(Date requested_at) {
        this.requested_at = requested_at;
    }
}
