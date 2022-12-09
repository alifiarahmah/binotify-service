package com.binotify.soap;

import com.binotify.soap.collections.LogsRepo;
import com.binotify.soap.collections.SubscriptionsRepo;
import com.binotify.soap.enums.Status;
import com.binotify.soap.entities.Subscription;

import jakarta.annotation.Resource;
import jakarta.jws.WebMethod;
import jakarta.jws.WebService;
import jakarta.jws.soap.SOAPBinding;
import jakarta.servlet.http.HttpServletRequest;
import jakarta.xml.ws.WebServiceContext;
import jakarta.xml.ws.handler.MessageContext;

@WebService
@SOAPBinding(style = SOAPBinding.Style.RPC)
public class SubscriptionService {
    // context
    @Resource
    WebServiceContext wsContext;

    // getter helper for ip address
    @WebMethod
    public String getIPAddress() {
        MessageContext mc = wsContext.getMessageContext();
        HttpServletRequest req = (HttpServletRequest) mc.get(MessageContext.SERVLET_REQUEST);
        System.out.println("Client IP = " + req.getRemoteAddr());
        return req.getRemoteAddr();
    }

    SubscriptionsRepo sRepo = new SubscriptionsRepo();
    LogsRepo lRepo = new LogsRepo();
    public Subscription[] generateSubscription() {
        Subscription a = new Subscription();
        a.setCreatorId((long) 2);
        a.setSubscriberId((long) 1);
        a.setStatus(Status.PENDING);
        Subscription b = new Subscription();
        b.setCreatorId((long) 1);
        b.setSubscriberId((long) 2);
        b.setStatus(Status.ACCEPTED);
        Subscription c = new Subscription();
        c.setCreatorId((long) 2);
        c.setSubscriberId((long) 5);
        c.setStatus(Status.PENDING);
        Subscription d = new Subscription();
        d.setCreatorId((long) 1);
        d.setSubscriberId((long) 5);
        d.setStatus(Status.PENDING);
        Subscription e = new Subscription();
        e.setCreatorId((long) 1);
        e.setSubscriberId((long) 1);
        e.setStatus(Status.PENDING);
        Subscription f = new Subscription();
        f.setCreatorId((long) 3);
        f.setSubscriberId((long) 5);
        f.setStatus(Status.ACCEPTED);
        Subscription[] result = {a, b, c, d, e, f};
        return result;
    }
    
    public Subscription[] getAllSubscriptions() {
        return sRepo.getAllSubsRequest().toArray(new Subscription[0]);
    }

    public String addSubscription(long creatorId, long subscriberId) {
        sRepo.addSubscription((long) creatorId, (long) subscriberId);
        String msg = String.format("Added new subscription request: creatorId=%d, subscriberId=%d", creatorId, subscriberId);
        lRepo.createLog(msg, getIPAddress(), "SubscriptionService");
        return msg;
    }

    public String editSubscription(long creatorId, long subscriberId, String status) {
        sRepo.editSubscription((long) creatorId, (long) subscriberId, status);
        String msg = String.format("Subscription with creatorId=%d, subscriberId=%d updated with status %s", creatorId, subscriberId, status);
        lRepo.createLog(msg, getIPAddress(), "SubscriptionService");
        return msg;
    }

    public String removeSubscription(long creatorId, long subscriberId) {
        sRepo.removeSubscription((long) creatorId, (long) subscriberId);
        String msg = String.format("Removed subscription request: creatorId=%d, subscriberId=%d", creatorId, subscriberId);
        lRepo.createLog(msg, getIPAddress(), "SubscriptionService");
        return msg;
    }

    public String log(String description, String endpoint) {
        lRepo.createLog(description, getIPAddress(), endpoint);
        String msg = String.format("Dummy log generated: description=%s, ip=%s, endpoint=%s", description, getIPAddress(), endpoint);
        return msg;
    }


}
