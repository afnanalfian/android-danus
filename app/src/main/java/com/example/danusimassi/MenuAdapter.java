package com.example.danusimassi;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import androidx.recyclerview.widget.RecyclerView;

import java.util.List;
public class MenuAdapter extends RecyclerView.Adapter<MenuAdapter.MenuHolder>{
    private Context mediaCtxt;
    private List<DaftarMenuItem> menuitem;
    public MenuAdapter(Context context, List<DaftarMenuItem> menuItemList)
    {
        this.mediaCtxt = context;
        this.menuitem = menuItemList;
    }
    @Override
    public MenuHolder onCreateViewHolder(ViewGroup parent, int viewType){
        View itemView = LayoutInflater.from(parent.getContext()).inflate(R.layout.item_menu, parent, false);
        return new MenuHolder(itemView);
    }
    @Override
    public void onBindViewHolder(MenuHolder holder, int position) {
        final DaftarMenuItem listmenuitem = menuitem.get(position);
        holder.txtmenumakanan.setText(listmenuitem.getMenu_makanan());
        holder.txtharga.setText("Rp."+listmenuitem.getHarga());
    }
    @Override
    public int getItemCount() {
        return (menuitem != null) ? menuitem.size() : 0;
    }
    public class MenuHolder extends RecyclerView.ViewHolder{
        private TextView txtmenumakanan, txtharga;
        public MenuHolder(View itemView) {
            super(itemView);
            txtmenumakanan = (TextView) itemView.findViewById(R.id.view_menu_makanan);
            txtharga = (TextView) itemView.findViewById(R.id.view_harga);
        }
    }
}
