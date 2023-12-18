package com.example.danusimassi;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;
import androidx.recyclerview.widget.RecyclerView;
import java.util.List;
public class OrderAdapter extends
        RecyclerView.Adapter<OrderAdapter.OrderHolder>{
    private Context mediaCtxt;
    private List<DaftarOrderItem> orderitem;
    public OrderAdapter(Context context, List<DaftarOrderItem> orderItemList) {
        this.mediaCtxt = context;
        this.orderitem = orderItemList;
    }
    @Override
    public OrderHolder onCreateViewHolder(ViewGroup parent, int viewType){
        View itemView = LayoutInflater.from(parent.getContext()).inflate(R.layout.item_menu, parent, false);
        return new OrderHolder(itemView);
    }
    @Override
    public void onBindViewHolder(OrderAdapter.OrderHolder holder, int
            position) {
        final DaftarOrderItem listorderitem = orderitem.get(position);
        holder.txtmenumakanan.setText(listorderitem.getMenu_makanan());
        holder.txtharga.setText("Rp."+listorderitem.getHarga());
        holder.txtusername.setText(listorderitem.getUsername());
        holder.txtjumlah.setText(listorderitem.getJumlah()+"x");
    }
    @Override
    public int getItemCount() {
        return (orderitem != null) ? orderitem.size() : 0;
    }
    public class OrderHolder extends RecyclerView.ViewHolder{
        private TextView txtmenumakanan, txtharga, txtusername, txtjumlah;
        public OrderHolder(View itemView) {
            super(itemView);
            txtmenumakanan = (TextView) itemView.findViewById(R.id.pesan_menu_makanan);
            txtharga = (TextView) itemView.findViewById(R.id.pesan_harga);
            txtusername = (TextView) itemView.findViewById(R.id.pesan_username);
            txtjumlah = (TextView) itemView.findViewById(R.id.pesan_jumlah);
        }
    }
}

