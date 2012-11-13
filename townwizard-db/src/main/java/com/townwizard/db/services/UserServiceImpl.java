package com.townwizard.db.services;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Component;
import org.springframework.transaction.annotation.Transactional;

import com.townwizard.db.dao.UserDao;
import com.townwizard.db.model.User;

@Transactional
@Component("userService")
public class UserServiceImpl implements UserService {    
    
    @Autowired
    private UserDao userDao;    

    @Override
    public User getUserById(Long id) {
        return userDao.getById(User.class, id);
    }
}