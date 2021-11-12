import numpy as np
import pickle
import json
import base64
import sys


def knn_prediction(features):
    home_features = json.loads(base64.b64decode(features))

    check_value = np.array(home_features)

    with open('/Applications/XAMPP/xamppfiles/htdocs/HomeExchange/tiermatch/tier_model_pickle','rb') as f:
        classifier = pickle.load(f)

    tier_prediction = classifier.predict([check_value])
    tier = tier_prediction[0]

    return tier  



if __name__ == "__main__":
    print(knn_prediction(sys.argv[1]))
