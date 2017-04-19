package com.example.panchamkhaitan.csc;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ArrayAdapter;
import android.widget.TextView;

import java.util.ArrayList;
import java.util.List;

/**
 * Created by panchamkhaitan on 19/04/17.
 */
public class ContactsAdapter extends ArrayAdapter {

    List list = new ArrayList();

    public ContactsAdapter(Context context, int resource) {
        super(context, resource);
    }


    public void add(Object object) {
        super.add(object);
        list.add(object);
    }

    @Override
    public int getCount() {
        return list.size();
    }

    @Override
    public Object getItem(int position) {
        return list.get(position);
    }

    @Override
    public View getView(int position, View convertView, ViewGroup parent) {
        View row;
        row = convertView;
        ContactHolder contactHolder;
        if (row == null) {
            LayoutInflater layoutInflater = (LayoutInflater) this.getContext().getSystemService(Context.LAYOUT_INFLATER_SERVICE);
            row = layoutInflater.inflate(R.layout.row_layout, parent, false);
            contactHolder = new ContactHolder();

            contactHolder.tx_parentName = (TextView) row.findViewById(R.id.parentName);
            contactHolder.tx_firstName = (TextView) row.findViewById(R.id.firstName);
            contactHolder.tx_email = (TextView) row.findViewById(R.id.email);
            contactHolder.tx_phoneNumber = (TextView) row.findViewById(R.id.phoneNumber);
            row.setTag(contactHolder);
        } else {
            contactHolder = (ContactHolder) row.getTag();
        }

        Contacts contacts = (Contacts) this.getItem(position);
        contactHolder.tx_parentName.setText("Hello, " + contacts.getFirstName() + "!");
        contactHolder.tx_firstName.setText("Full Name: " + contacts.getFirstName() + contacts.getLastName());
//        contactHolder.tx_lastName.setText(contacts.getLastName());
        contactHolder.tx_email.setText("Email: " + contacts.getEmail());
        contactHolder.tx_phoneNumber.setText("Phone Number: " + contacts.getPhoneNumber());
        return row;
    }

    static class ContactHolder {
        TextView tx_parentName, tx_firstName, tx_email, tx_phoneNumber;
    }
}