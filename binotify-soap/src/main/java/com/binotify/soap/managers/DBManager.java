package com.binotify.soap.managers;

import jakarta.persistence.EntityManager;
import jakarta.persistence.EntityManagerFactory;
import jakarta.persistence.Persistence;

public class DBManager {
    private static EntityManagerFactory emFactory = Persistence.createEntityManagerFactory("binotify_soapdb");

    // getter
    public static EntityManager getEntityManager() {
        EntityManager entityManager = emFactory.createEntityManager();
        return entityManager;
    }
}
