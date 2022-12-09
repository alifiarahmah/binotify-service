package com.binotify.soap;

import jakarta.jws.WebService;
import jakarta.jws.soap.SOAPBinding;

@WebService
@SOAPBinding(style = SOAPBinding.Style.DOCUMENT)
public class TestService {
    public String ping() {
        return "pong";
    }
    public String haha() { return "haha"; }

    public String test(String text, String text2) {
        if (text == null || text.isEmpty()) {
            return "null";
        } else {
            return text;
        }
    }

    /*
    public List<Subscription> getSubs() {
        SubscriptionsRepo subsRepo = new SubscriptionsRepo();
        return subsRepo.getAllSubsRequest(new Long(10), new Long(0));
    }
     */
}
