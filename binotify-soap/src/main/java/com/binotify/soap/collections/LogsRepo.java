package com.binotify.soap.collections;

import com.binotify.soap.entities.Logging;
import com.binotify.soap.managers.DBManager;
import jakarta.persistence.EntityManager;

import java.util.Date;

public class LogsRepo {
    private EntityManager em;

    // constructor
    public LogsRepo() {
        this.em = DBManager.getEntityManager();
    }

    public Boolean createLog(String description, String ip, String endpoint){

        Logging l = new Logging();
        l.setDescription(description);
        l.setIp(ip);
        l.setEndpoint(endpoint);

        em.persist(l);

        em.getTransaction().begin();
        em.getTransaction().commit();
        return true;
    }
}
