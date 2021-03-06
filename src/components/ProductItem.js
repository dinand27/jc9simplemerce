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

    addToCart = () => {
        console.log('addtocart BUtton')

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

                    <input type="number" value={this.state.quantity} name="quantity" 
                    onChange={this.handleInputChange} className="float-right" 
                    style={{ width: "60px", marginRight: "10px", borderRadius: "3px"}}/>

                    <Link to={'/detailproduct/' + id}>
                        <button className='btn btn-outline-primary btn-block'>Details</button>
                    </Link>
                    <button className='btn btn-primary btn-block' onClick={this.addtoCart} >Add To Cart</button>
                </div>
            </div>
        )
    }
} 

export default ProductItem