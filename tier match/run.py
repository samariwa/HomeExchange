from flask import Flask, jsonify, Blueprint, render_template, request
import os
import ml 

app = Flask(__name__)
@app.route('/')
def get():
    dataGet = request.get_json(force=True)
    print(dataGet)
    datareply = {'this':'that'}
    return jsonify(datareply)



#house_features = [0,0,0,0,1,1,2,1,4,0,0,0,0,0,0,0,0,1]

#tier_prediction = ml.knn_prediction(house_features)

