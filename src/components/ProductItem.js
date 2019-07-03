import React, { Component } from 'react'
import { Link } from 'react-router-dom'
import axios from 'axios'


class ProductItem extends Component {
    state = {
        product: {
            id: '',
            name: '',
            price: '',
            src: ''
        }, selectedId:0,
        cart:[]
    }
    componentDidMount(){
        // Akses database
        this.getProduct()
    }
    
    getProduct = () => {
        axios.get('http://localhost:2019/products')
        .then(res =>{
            this.setState({product: res.data, selectedId: 0})
            console.log(res)
        })
    }

    addtoCart = id => {
        var nama = this.props.barang.name
        var desk = this.props.barang.desc
        var harga = this.props.barang.harga

        axios.patch(
            'http://localhost:2019/cart/' + id,
            {
                name: nama,
                desc: desk,
                price: harga
            }
        ).then(res => {
            this.getProduct()
        }).catch(err => {
            console.log('Gagal patch')
        })
    }   

    //     axios.post(
    //         'http://localhost:2019/cart',
    //         {
    //             desc,
    //             name,
    //             price,
    //             src : pict
    //         }
    //     ).then(res => {
    //         // GET DATA
    //         this.getProduct()
    //     })
    // }



    render(){
        var {id, name, price, src} = this.props.barang // {id, name, desc, price, src}
        // id = 1
    
        return (
            <div className="card col-3 m-5">
                <img src={src} className='card-img-top'/>
                <div className='card-body'>
                    <h5 className='card-title'>{name}</h5>
                    <p className='card-text'>IDR.{price}</p>
                    <input type='text' className='form-control'/>
                    <Link to={'/detailproduct/' + id}>
                        <button className='btn btn-outline-primary btn-block'>Details</button>
                    </Link>
                    <button className='btn btn-primary btn-block' onClick={this.addtoCart}  >Add To Cart</button>
                </div>
            </div>
        )
    }
} 

export default ProductItem