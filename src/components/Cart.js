import React, { Component } from 'react'
import axios from 'axios'
import { isTSEnumMember } from '@babel/types';

class ManageProduct extends Component {
    state = {
        products: [],
        selectedId: 0
    }

    componentDidMount(){
        // Akses database
        this.getProduct()
    }

    onSaveItem = id => {
        var nama = this.editName.value
        var desk = this.editDesc.value
        var harga = this.editPrice.value

        axios.patch(
            'http://localhost:2019/products/' + id,
            {
                name: nama,
                desc: desk,
                price: harga
            }
        ).then(res => {
            this.getProduct()
        }).catch(err => {
            console.log('Gagal')
        })
    }
    checkOut=() => {
        console.log('checkout button')

    }

    onDeleteItem = (id) => {
        axios.delete('http://localhost:2019/products/' + id)
        .then(() => {
            this.getProduct()
        })
    }

    getProduct = () => {
        axios.get('http://localhost:2019/products')
            .then(res => {
               this.setState({products: res.data, selectedId: 0})
            })
    }

    addProduct = () => {
        const name = this.name.value
        const desc = this.desc.value
        const price = parseInt(this.price.value)
        const pict = this.pict.value
        const Qty= this.Qty.value

        axios.post(
            'http://localhost:2019/products',
            {
                desc,
                name,
                price,
                src : pict,
                Qty
            }
        ).then(res => {
            // GET DATA
            this.getProduct()
        })
    }

    renderList = () => {
        return this.state.products.map( item => { // {id, name, price, desc, src}
            if(item.id !== this.state.selectedId){
                return (
                    <tr>
                        <td>{item.id}</td>
                        <td>{item.name}</td>
                        <td>{item.desc}</td>
                        <td>{item.price}</td>
                        <td>
                            <img className='list' src={item.src}/>
                        </td>
                        <td>{item.Qty}</td>
                        <td>
                            
                            <button onClick={()=>{this.onDeleteItem(item.id)}} className = 'btn btn-warning'>Delete</button>
                        </td>
                    </tr>
                )
            } else {
                return (
                    <tr>
                        <td>{item.id}</td>
                        <td>
                            <input className="form-control" ref={input => {this.editName = input}} type="text" defaultValue={item.name}/>
                        </td>
                        <td>
                            <input className="form-control" ref={input => {this.editDesc = input}} type="text" defaultValue={item.desc}/>
                        </td>
                        <td>
                            <input className="form-control" ref={input => {this.editPrice = input}} type="text" defaultValue={item.price}/>
                        </td>
                        <td>
                            <img className='list' src={item.src}/>
                        </td>
                        <td>
                            <input className="form-control" ref={input => {this.editQty = input}} type="text" defaultValue={item.Qty}/>
                        </td>

                        
                    </tr>
                )
            }
        })
    }

    render () {
        return (
            <div className="container">
                <h1 className="display-4 text-center">Cart</h1>
                <table className="table table-hover mb-5">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">NAME</th>
                            <th scope="col">DESC</th>
                            <th scope="col">PRICE</th>
                            <th scope="col">PICTURE</th>
                            <th scope="col">Qty</th>
                            <th scope="col">ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        {this.renderList()}
                    </tbody>
                </table>
                <div className='col text-center'>
                    <button id='' name='' className='btn btn-primary' onClick={this.checkOut}>CheckOut</button>
                </div>
                
            </div>
        )
    }

}

export default ManageProduct