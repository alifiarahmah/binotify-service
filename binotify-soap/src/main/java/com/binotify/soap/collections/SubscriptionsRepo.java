package com.binotify.soap.collections;

import com.binotify.soap.managers.DBManager;
import com.binotify.soap.enums.Status;
import com.binotify.soap.entities.Subscription;
import com.binotify.soap.entities.SubscriptionKey;
import jakarta.persistence.EntityManager;

import java.util.List;

public class SubscriptionsRepo {
    private EntityManager em;
    private Boolean manualTransaction = false;

    // constructor
    public SubscriptionsRepo() {
        this.em = DBManager.getEntityManager();
    }

    public SubscriptionsRepo(Boolean manualTransaction) {
        em = DBManager.getEntityManager();
        this.manualTransaction = manualTransaction;
    }


    // database affairs
    public List<Subscription> getAllSubsRequest() {
        return em.createQuery("select s from Subscription s").getResultList();
    }

    public Boolean addSubscription(Long creatorId, Long subscriberId) {
        Subscription s = new Subscription();
        s.setStatus(Status.PENDING);
        s.setCreatorId(creatorId);
        s.setSubscriberId(subscriberId);
        System.out.println(s.getStatus().toString());
        if (!manualTransaction) {
            em.getTransaction().begin();
        }
        em.persist(s);

        if (!manualTransaction) {
            em.getTransaction().commit();
        }
        return true;
    }

    public Boolean editSubscription(Long creatorId, Long subscriberId, String status) {
        System.out.println(status);


        SubscriptionKey sk = new SubscriptionKey();
        sk.setCreatorId(creatorId);
        sk.setSubscriberId(subscriberId);

        Subscription s = em.find(Subscription.class, sk);
        System.out.println(s);
        if (status.equals("ACCEPTED")) {
            s.setStatus(Status.ACCEPTED);
        }
        else if (status.equals("REJECTED")) {
            s.setStatus(Status.REJECTED);
        }
        else if (status.equals("PENDING")) {
            s.setStatus(Status.PENDING);
        }
        System.out.println(s);

        em.merge(s);

        em.getTransaction().begin();
        em.getTransaction().commit();
        return true;
    }

    public Boolean removeSubscription(Long creatorId, Long subscriberId) {
        SubscriptionKey sk = new SubscriptionKey();
        sk.setCreatorId(creatorId);
        sk.setSubscriberId(subscriberId);

        Subscription s = em.find(Subscription.class, sk);
        System.out.println(s);
        em.remove(s);

        em.getTransaction().begin();
        em.getTransaction().commit();

        return true;
    }

}


