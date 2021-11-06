import ml

def run():
    house_features = [0,0,0,0,1,1,2,1,4,0,0,0,0,0,0,0,0,1]
    tier_prediction = ml.knn_prediction(house_features)
    return tier_prediction
 #python -c 'import run; print run.run()'
