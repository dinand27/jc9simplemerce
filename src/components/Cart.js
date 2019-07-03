import React, { Component } from 'react'
import { Link } from 'react-router-dom'
import Redux from 'redux'

class Cart extends Component {
render(){
    return(
        <div>
        <p>ini dari komponen cart</p>
        <p>
            <Link to='/'>
            Belanja Lagi
            </Link>        
        </p>
<table>
    {this.renderList()}
</table>
        </div>

    )
}

}
export default Cart